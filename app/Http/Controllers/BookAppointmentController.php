<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Mpdf\Mpdf;
use App\Mail\SendConfigurationPdf;
use App\Models\Appointment;
use Illuminate\Support\Facades\Mail;


class BookAppointmentController extends Controller
{
    public function bookAppointment(Request $request)
    {

        $validationRules = [
            'configurationData' => 'nullable|array',
            'configurationData.brakes' => 'string',
            'configurationData.exteriorPaint' => 'string',
            'configurationData.interiorColor' => 'string',
            'configurationData.interiorMaterial' => 'string',
            'configurationData.model' => 'string',
            'configurationData.tires' => 'string',
            'selectedCountry' => 'required|string',
            'selectedCity' => 'required|string',
            'selectedAddress' => 'required|string',
            'personalData' => 'required|array',
            'personalData.fullName' => 'required|string|max:100',
            'personalData.email' => 'required|email|max:100',
            'personalData.phoneNumber' => 'required|string|max:20|regex:/^[\d+]+$/',
            'personalData.privacy' => 'required|boolean',
            'personalData.sendEmail' => 'boolean',
        ];
        $errorMessages = [
            'personalData.fullName.required' => 'The Full Name is required.',
            'personalData.fullName.max' => 'The Full Name length cannot be greater than 100 characters.',
            'personalData.phoneNumber.required' => 'The phone number is required.',
            'personalData.phoneNumber.regex' => 'The phone number length is too long! Pick a real one 😡.',
            'personalData.phoneNumber.max' => 'The phone number lenght cannot be greater than 20 digits.',
            'personalData.email.required' => 'The email is required.',
            'personalData.email.max' => 'The email length cannot be greater than 100 characters.',
            /* 'personalData.*.required' => 'The :attribute field is required.', */
            'personalData.email' => 'The email must be a valid email address.',
            'personalData.privacy.required' => 'In order to proceed, you must consent to the processing of your personal data.',
            'selectedCountry' => 'You must select a country',
            'selectedCity' => 'You must select a city',
            'selectedAddress' => 'You must select an address',
        ];

        $validatedData = $request->validate($validationRules, $errorMessages);



        //generate a new Appointment
        $appointmentData = [
            'fullName' => $validatedData['personalData']['fullName'],
            'email' => $validatedData['personalData']['email'],
            'phoneNumber' => $validatedData['personalData']['phoneNumber'],
            'address' => json_encode([
                'country' => $validatedData['selectedCountry'],
                'city' => $validatedData['selectedCity'],
                'address' => $validatedData['selectedAddress'],
            ]),
        ];
        //**configuration data is nullable
        if (isset($validatedData['configurationData'])) {
            $appointmentData['configurationData'] = json_encode($validatedData['configurationData']);
        }

        $appointment = Appointment::create($appointmentData);

        //if the appointment was succesfully generated and sendEmail is true, generates a pdf and sends an Email
        if ($appointment) {
            //generate a pdf file
            $fileName = 'car_configuration_' . date('Ymd_His') . '.pdf';
            $filePath = storage_path('/pdf/' . $fileName);
            $html = view(
                'carConfigurationPdf',
                compact('validatedData')
            )->render();

            $mpdf = new Mpdf();

            $mpdf->WriteHTML($html);

            // Output PDF and save to file at $filePath
            $mpdf->Output($filePath, 'F');

            if (file_exists($filePath)) {
                if ($validatedData['personalData']['sendEmail'] === true) {
                    $email = new SendConfigurationPdf($filePath, $validatedData);
                    Mail::to($validatedData['personalData']['email'])->send($email);
                    return redirect()->route('findYourDealer')->with(['message' => 'Appointment Generated and email sent successfully.']);
                }
                return redirect()->route('findYourDealer')->with(['message' => 'Appointment generated succesfully.']);
            } else {
                return redirect()->route('findYourDealer')->with(['message' => 'Appointment generated, Failed to send Email.'], 500);
            }
        } else {
            return redirect()->route('findYourDealer')->with(['message' => 'Failed to generate Appointment 😔']);
        }
    }
}

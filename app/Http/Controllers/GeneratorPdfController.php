<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mpdf\Mpdf;
use App\Mail\SendConfigurationPdf;
use Illuminate\Support\Facades\Mail;


class GeneratorPdfController extends Controller
{
    public function generatePdf(Request $request)
    {

        $validationRules = [
            'configurationData' => 'array',
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
            'personalData.fullName' => 'required|string',
            'personalData.email' => 'required|email',
            'personalData.phoneNumber' => 'required|string',
            'personalData.privacy' => 'required|boolean',
            'personalData.sendEmail' => 'boolean',
        ];
        $errorMessages = [
            'personalData.fullName.required' => 'The Full Name is required.',
            'personalData.phoneNumber.required' => 'The phone number is required.',
            'personalData.email.required' => 'The email is required.',
            /* 'personalData.*.required' => 'The :attribute field is required.', */
            'personalData.email' => 'The email must be a valid email address.',
            'personalData.privacy.required' => 'In order to proceed, you must consent to the processing of your personal data.',
            'selectedCountry' => 'You must select a country',
            'selectedCity' => 'You must select a city',
            'selectedAddress' => 'You must select an address',
        ];

        $validatedData = $request->validate($validationRules, $errorMessages);




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
                return redirect()->route('findYourDealer')->with(['message' => 'PDF generated and email sent successfully.']);
            }
            return redirect()->route('findYourDealer')->with(['message' => 'PDF generated successfully.']);
        } else {
            return redirect()->route('findYourDealer')->with(['message' => 'Failed to generate PDF.'], 500);
        }
    }
}

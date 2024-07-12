<?php

namespace App\Http\Controllers;

use App\Models\PaintSpecialistAppointment;
use Illuminate\Http\Request;

class PaintSpecialistController extends Controller
{
    public function paintSpecialist(Request $request)
    {

        //validation
        unset($validatedData);
        $validationRules = [
            'fullName' => 'required|string',
            'email' => 'required|email',
            'phoneNumber' => 'required|string|regex:/^[\d+]+$/|max:20',
            'privacy' => 'required|boolean',

        ];
        $validationErrors = [
            'fullName.required' => 'the full name is required',
            'fullName.string' => 'the full name must be a string',
            'fullName.max'=> 'The full name length cannot be greater than 100 characters',
            'email.required' => 'the email is required',
            'email.email' => 'the e-mail must be in a proper e-mail format',
            'email.max'=> 'The email length cannot be greater than 100 characters',
            'phoneNumber.required' => 'the phone number is required',
            'phoneNumber.regex' => "the phone number must contain only numbers and the '+' sign",
            'phoneNumber.max' => 'the phone number is too long! Pick a real one 😡',
            'privacy.required' => 'In order to proceed, you must consent to the processing of your personal data.',
        ];

        $validatedData = $request->validate($validationRules, $validationErrors);

        //create an new Appointment
        unset($appointmentData);
        unset($appointment);
        $appointmentData = [
            'fullName' => $validatedData['fullName'],
            'email' => $validatedData['email'],
            'phoneNumber' => $validatedData['phoneNumber'],
        ];
        $appointment = PaintSpecialistAppointment::create($appointmentData);

        if ($appointment) {
            $message = 'Appointment succesfully Booked!';
        } else {
            $message = 'There has been an issue booking the appointment.';
        }




        return redirect()->route('configure')->with([
            'message' => $message
        ]);
    }
}
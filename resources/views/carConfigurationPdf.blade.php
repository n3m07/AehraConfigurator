<!DOCTYPE html>
<html lang="en">
<!-- VIEW STRUCTURE FOR PDF GENERATION -->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    @if(!empty($validatedData['configurationData']))
    <div>
        <h1>Your Current configuration:</h1>
        <div>Model: {{$validatedData['configurationData']['model']}}</div>
        <div>Exterior Paint: {{$validatedData['configurationData']['exteriorPaint']}}</div>
        <div>Inteiror Color: {{$validatedData['configurationData']['interiorColor']}}</div>
        <div>Inteiror Material: {{$validatedData['configurationData']['interiorMaterial']}}</div>
        <div>Tires: {{$validatedData['configurationData']['tires']}}</div>
        <div>Brakes: {{$validatedData['configurationData']['brakes']}}</div>
    </div>
    @endif
    <div>
        <h1>Dealers Address:</h1>
        <div>Address: {{$validatedData['selectedAddress']}}</div>
        <div>City: {{$validatedData['selectedCity']}}</div>
        <div>Country: {{$validatedData['selectedCountry']}}</div>
    </div>
    <div>
        <h1>Personal Informations:</h1>
        <div>Full name: {{$validatedData['personalData']['fullName']}}</div>
        <div>E-mail address: {{$validatedData['personalData']['email']}}</div>
        <div>Phone Number: {{$validatedData['personalData']['phoneNumber']}}</div>
        <div>Send Confirmation E-mail: {{$validatedData['personalData']['sendEmail']? 'Yes': 'No'}}</div>
    </div>
</body>

</html>
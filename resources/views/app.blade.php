<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Questrial&display=swap" rel="stylesheet">

    <style>
    .questrial-regular {
        font-family: "Questrial", sans-serif;
        font-weight: 400;
        font-style: normal;
    }
    </style>
    @vite(['resources/js/app.js', 'resources/css/app.css'])
    @routes
    @inertiaHead
</head>

<body>
    @inertia
</body>

</html>
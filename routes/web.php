<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Models\Car;
use Illuminate\Http\Request;
use App\Http\Controllers\GeneratorPdfController;
use App\Models\Country;



//configurator view
Route::get('/configurator', function () {
    $title = 'Configurator';
    $cars = Car::all();
    /* $route = Route::currentRouteName();
    dd($route); */

    return Inertia::render('configure', [
        'title' => $title,
        'cars' => $cars,
        'route' => Route::currentRouteName(),
    ]);
})->name('configure');

//route to generate a pdf
Route::post('/configurator', [GeneratorPdfController::class, 'generatePdf'])->name('generatePdf');


//find your dealer route
Route::get('/find-your-dealer', function (Request $request) {
    $countries = Country::with('cities.addresses')->get();
    $data = $request->all();
    $title = 'Find Your Dealer';

    if (!empty($data)) {
        return Inertia::render('findYourDealer', [
            'data' => $data,
            'countries' => $countries,
            'title' => $title,
            'route' => Route::currentRouteName(),
        ]);
    } else {
        return Inertia::render('findYourDealer', [
            'countries' => $countries,
            'title' => $title,
            'route' => Route::currentRouteName(),
        ]);
    }
})->name('findYourDealer');
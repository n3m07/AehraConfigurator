<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Car;

class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Car::create([
            'model' => 'Furor',
            'interiorColor' => ['CloudWhite', 'FresoRed', 'FresoGreen', 'FresoBlue', 'FresoPink', 'FresoLime'],
            'interiorMaterial' => ['Leather', 'alcantara'],
            'exteriorColor' => ['CloudWhite', 'FresoRed', 'FresoGreen', 'FresoBlue', 'FresoPink', 'FresoLime'],
            'rims' => ['Long Range', 'Short Range'],
            'brakes' => ['yellow', 'black', 'red'],
        ]);
        Car::create([
            'model' => 'Impetus',
            'interiorColor' => ['CloudWhite', 'FresoRed', 'FresoGreen', 'FresoBlue', 'FresoPink', 'FresoLime'],
            'interiorMaterial' => ['Leather', 'alcantara'],
            'exteriorColor' => ['CloudWhite', 'FresoRed', 'FresoGreen', 'FresoBlue', 'FresoPink', 'FresoLime'],
            'rims' => ['Long Range', 'Short Range'],
            'brakes' => ['yellow', 'black', 'red'],
        ]);
        Car::create([
            'model' => 'Extasis',
            'interiorColor' => ['CloudWhite', 'FresoRed', 'FresoGreen', 'FresoBlue', 'FresoPink', 'FresoLime'],
            'interiorMaterial' => ['Leather', 'alcantara'],
            'exteriorColor' => ['CloudWhite', 'FresoRed', 'FresoGreen', 'FresoBlue', 'FresoPink', 'FresoLime'],
            'rims' => ['Long Range', 'Short Range'],
            'brakes' => ['yellow', 'black', 'red'],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountriesTableSeeder extends Seeder
{
    public function run()
    {
        $countries = [
            [
                'country' => 'Italy',
                'cities' => [
                    [
                        'city' => 'Milan',
                        'addresses' => [
                            ['address' => 'via visconti 10', 'lat' => 45.4642, 'lng' => 9.1900],
                            ['address' => 'via milano 10', 'lat' => 45.4654, 'lng' => 9.1865],
                        ],
                    ],
                    [
                        'city' => 'Rome',
                        'addresses' => [
                            ['address' => 'via visconti 10', 'lat' => 41.9028, 'lng' => 12.4964],
                            ['address' => 'via roma 10', 'lat' => 41.9000, 'lng' => 12.5000],
                        ],
                    ],
                ],
            ],
            [
                'country' => 'Germany',
                'cities' => [
                    [
                        'city' => 'Munich',
                        'addresses' => [
                            ['address' => 'via germania 10', 'lat' => 48.1351, 'lng' => 11.5820],
                            ['address' => 'via alemania 20', 'lat' => 48.1374, 'lng' => 11.5755],
                        ],
                    ],
                ],
            ],
            [
                'country' => 'France',
                'cities' => [
                    [
                        'city' => 'Paris',
                        'addresses' => [
                            ['address' => 'via francia 10', 'lat' => 48.8566, 'lng' => 2.3522],
                            ['address' => 'via gallia 20', 'lat' => 48.8584, 'lng' => 2.2945],
                        ],
                    ],
                    [
                        'city' => 'Lyon',
                        'addresses' => [
                            ['address' => 'via lione 10', 'lat' => 45.7640, 'lng' => 4.8357],
                            ['address' => 'via tigrone 20', 'lat' => 45.7679, 'lng' => 4.8348],
                        ],
                    ],
                ],
            ],
        ];

        foreach ($countries as $countryData) {
            $country = DB::table('countries')->insertGetId([
                'country' => $countryData['country'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            foreach ($countryData['cities'] as $cityData) {
                $city = DB::table('cities')->insertGetId([
                    'country_id' => $country,
                    'city' => $cityData['city'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                foreach ($cityData['addresses'] as $addressData) {
                    DB::table('addresses')->insert([
                        'city_id' => $city,
                        'address' => $addressData['address'],
                        'lat' => $addressData['lat'],
                        'lng' => $addressData['lng'],
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}

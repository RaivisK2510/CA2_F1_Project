<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Circuit;

class CircuitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $circuits = [
            [
                'name' => 'Silverstone',
                'full_name' => 'Silverstone Circuit',
                'country' => 'United Kingdom',
                'city' => 'Silverstone',
                'latitude' => 52.0786,
                'longitude' => -1.0169,
                'length_km' => 5.891,
                'lap_record_seconds' => 82.569,
                'lap_record_driver' => 'Max Verstappen',
                'lap_record_year' => 2020,
                'corners' => 18,
                'drs_zones' => 3,
                'direction' => 'clockwise',
                'first_grand_prix' => 1950,
                'races_held' => 55,
                'is_active' => true,
            ],
            [
                'name' => 'Monza',
                'full_name' => 'Autodromo Nazionale Monza',
                'country' => 'Italy',
                'city' => 'Monza',
                'latitude' => 45.6156,
                'longitude' => 9.2811,
                'length_km' => 5.793,
                'lap_record_seconds' => 79.509,
                'lap_record_driver' => 'Rubens Barrichello',
                'lap_record_year' => 2004,
                'corners' => 11,
                'drs_zones' => 2,
                'direction' => 'clockwise',
                'first_grand_prix' => 1950,
                'races_held' => 73,
                'is_active' => true,
            ],
            [
                'name' => 'Spa-Francorchamps',
                'full_name' => 'Circuit de Spa-Francorchamps',
                'country' => 'Belgium',
                'city' => 'Spa',
                'latitude' => 50.4372,
                'longitude' => 5.9714,
                'length_km' => 7.004,
                'lap_record_seconds' => 106.512,
                'lap_record_driver' => 'Lewis Hamilton',
                'lap_record_year' => 2020,
                'corners' => 19,
                'drs_zones' => 3,
                'direction' => 'clockwise',
                'first_grand_prix' => 1950,
                'races_held' => 55,
                'is_active' => true,
            ],
            [
                'name' => 'Monaco',
                'full_name' => 'Circuit de Monaco',
                'country' => 'Monaco',
                'city' => 'Monte Carlo',
                'latitude' => 43.7347,
                'longitude' => 7.4206,
                'length_km' => 3.337,
                'lap_record_seconds' => 72.909,
                'lap_record_driver' => 'Lewis Hamilton',
                'lap_record_year' => 2021,
                'corners' => 19,
                'drs_zones' => 2,
                'direction' => 'clockwise',
                'first_grand_prix' => 1950,
                'races_held' => 69,
                'is_active' => true,
            ],
            [
                'name' => 'Suzuka',
                'full_name' => 'Suzuka International Racing Course',
                'country' => 'Japan',
                'city' => 'Suzuka',
                'latitude' => 34.8431,
                'longitude' => 136.5345,
                'length_km' => 5.807,
                'lap_record_seconds' => 89.478,
                'lap_record_driver' => 'Lewis Hamilton',
                'lap_record_year' => 2019,
                'corners' => 18,
                'drs_zones' => 2,
                'direction' => 'figure-eight',
                'first_grand_prix' => 1987,
                'races_held' => 35,
                'is_active' => true,
            ],
        ];

        foreach ($circuits as $circuit) {
            Circuit::create($circuit);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Driver;

class DriverSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $drivers = [
            [
                'first_name' => 'Max',
                'last_name' => 'Verstappen',
                'code' => 'VER',
                'driver_number' => 1,
                'date_of_birth' => '1997-09-30',
                'nationality' => 'Dutch',
                'place_of_birth' => 'Hasselt, Belgium',
                'height_cm' => 181,
                'weight_kg' => 72,
                'debut_year' => '2015-01-01',
                'wins' => 61,
                'podiums' => 105,
                'pole_positions' => 39,
                'fastest_laps' => 35,
                'career_points' => 2831,
                'world_championships' => 3,
                'is_active' => true,
            ],
            [
                'first_name' => 'Lewis',
                'last_name' => 'Hamilton',
                'code' => 'HAM',
                'driver_number' => 44,
                'date_of_birth' => '1985-01-07',
                'nationality' => 'British',
                'place_of_birth' => 'Stevenage, England',
                'height_cm' => 174,
                'weight_kg' => 73,
                'debut_year' => '2007-01-01',
                'wins' => 103,
                'podiums' => 201,
                'pole_positions' => 104,
                'fastest_laps' => 67,
                'career_points' => 4405,
                'world_championships' => 7,
                'is_active' => true,
            ],
            [
                'first_name' => 'Charles',
                'last_name' => 'Leclerc',
                'code' => 'LEC',
                'driver_number' => 16,
                'date_of_birth' => '1997-10-16',
                'nationality' => 'Monegasque',
                'place_of_birth' => 'Monte Carlo, Monaco',
                'height_cm' => 180,
                'weight_kg' => 70,
                'debut_year' => '2018-01-01',
                'wins' => 5,
                'podiums' => 31,
                'pole_positions' => 26,
                'fastest_laps' => 7,
                'career_points' => 1544,
                'world_championships' => 0,
                'is_active' => true,
            ],
            [
                'first_name' => 'Lando',
                'last_name' => 'Norris',
                'code' => 'NOR',
                'driver_number' => 4,
                'date_of_birth' => '1999-11-13',
                'nationality' => 'British',
                'place_of_birth' => 'Bristol, England',
                'height_cm' => 170,
                'weight_kg' => 68,
                'debut_year' => '2019-01-01',
                'wins' => 1,
                'podiums' => 16,
                'pole_positions' => 3,
                'fastest_laps' => 2,
                'career_points' => 631,
                'world_championships' => 0,
                'is_active' => true,
            ],
            [
                'first_name' => 'Fernando',
                'last_name' => 'Alonso',
                'code' => 'ALO',
                'driver_number' => 14,
                'date_of_birth' => '1981-07-29',
                'nationality' => 'Spanish',
                'place_of_birth' => 'Oviedo, Spain',
                'height_cm' => 171,
                'weight_kg' => 68,
                'debut_year' => '2001-01-01',
                'wins' => 32,
                'podiums' => 106,
                'pole_positions' => 22,
                'fastest_laps' => 24,
                'career_points' => 2245,
                'world_championships' => 2,
                'is_active' => true,
            ],
        ];

        foreach ($drivers as $driver) {
            Driver::create($driver);
        }
    }
}

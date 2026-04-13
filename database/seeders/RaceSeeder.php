<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Race;
use App\Models\Circuit;
use App\Models\Season;

class RaceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get seasons and circuits
        $season2024 = Season::where('year', 2024)->first();
        $season2023 = Season::where('year', 2023)->first();
        $season2022 = Season::where('year', 2022)->first();

        // Get some circuits - use first available circuits if specific ones don't exist
        $circuits = Circuit::all();
        $bahrain = $circuits->firstWhere('name', 'Bahrain International Circuit') ?? $circuits->first();
        $silverstone = $circuits->firstWhere('name', 'Silverstone') ?? $circuits->skip(1)->first() ?? $circuits->first();
        $monza = $circuits->firstWhere('name', 'Monza') ?? $circuits->skip(2)->first() ?? $circuits->first();
        $monaco = $circuits->firstWhere('name', 'Monaco') ?? $circuits->skip(3)->first() ?? $circuits->first();
        $spa = $circuits->firstWhere('name', 'Circuit de Spa-Francorchamps') ?? $circuits->skip(4)->first() ?? $circuits->first();

        // 2024 Season Races (sample)
        $races2024 = [
            [
                'season_id' => $season2024->id,
                'circuit_id' => $bahrain->id,
                'round_number' => 1,
                'name' => 'Bahrain Grand Prix',
                'full_name' => 'Bahrain Grand Prix 2024',
                'official_name' => 'Formula 1 Gulf Air Bahrain Grand Prix 2024',
                'race_date' => '2024-03-02',
                'laps' => 57,
                'race_distance_km' => 308.238,
                'is_completed' => true,
                'is_active' => true,
            ],
            [
                'season_id' => $season2024->id,
                'circuit_id' => $silverstone->id,
                'round_number' => 10,
                'name' => 'British Grand Prix',
                'full_name' => 'British Grand Prix 2024',
                'official_name' => 'Formula 1 Rolex British Grand Prix 2024',
                'race_date' => '2024-07-07',
                'laps' => 52,
                'race_distance_km' => 306.198,
                'is_completed' => true,
                'is_active' => true,
            ],
            [
                'season_id' => $season2024->id,
                'circuit_id' => $monza->id,
                'round_number' => 16,
                'name' => 'Italian Grand Prix',
                'full_name' => 'Italian Grand Prix 2024',
                'official_name' => 'Formula 1 Pirelli Gran Premio d\'Italia 2024',
                'race_date' => '2024-09-01',
                'laps' => 53,
                'race_distance_km' => 306.720,
                'is_completed' => true,
                'is_active' => true,
            ],
        ];

        // 2023 Season Races (sample)
        $races2023 = [
            [
                'season_id' => $season2023->id,
                'circuit_id' => $bahrain->id,
                'round_number' => 1,
                'name' => 'Bahrain Grand Prix',
                'full_name' => 'Bahrain Grand Prix 2023',
                'official_name' => 'Formula 1 Gulf Air Bahrain Grand Prix 2023',
                'race_date' => '2023-03-05',
                'laps' => 57,
                'race_distance_km' => 308.238,
                'is_completed' => true,
                'is_active' => false,
            ],
            [
                'season_id' => $season2023->id,
                'circuit_id' => $monaco->id,
                'round_number' => 6,
                'name' => 'Monaco Grand Prix',
                'full_name' => 'Monaco Grand Prix 2023',
                'official_name' => 'Formula 1 Grand Prix de Monaco 2023',
                'race_date' => '2023-05-28',
                'laps' => 78,
                'race_distance_km' => 260.286,
                'is_completed' => true,
                'is_active' => false,
            ],
            [
                'season_id' => $season2023->id,
                'circuit_id' => $spa->id,
                'round_number' => 12,
                'name' => 'Belgian Grand Prix',
                'full_name' => 'Belgian Grand Prix 2023',
                'official_name' => 'Formula 1 Rolex Belgian Grand Prix 2023',
                'race_date' => '2023-07-30',
                'laps' => 44,
                'race_distance_km' => 308.048,
                'is_completed' => true,
                'is_active' => false,
            ],
        ];

        // 2022 Season Races (sample)
        $races2022 = [
            [
                'season_id' => $season2022->id,
                'circuit_id' => $bahrain->id,
                'round_number' => 1,
                'name' => 'Bahrain Grand Prix',
                'full_name' => 'Bahrain Grand Prix 2022',
                'official_name' => 'Formula 1 Gulf Air Bahrain Grand Prix 2022',
                'race_date' => '2022-03-20',
                'laps' => 57,
                'race_distance_km' => 308.238,
                'is_completed' => true,
                'is_active' => false,
            ],
            [
                'season_id' => $season2022->id,
                'circuit_id' => $silverstone->id,
                'round_number' => 10,
                'name' => 'British Grand Prix',
                'full_name' => 'British Grand Prix 2022',
                'official_name' => 'Formula 1 Rolex British Grand Prix 2022',
                'race_date' => '2022-07-03',
                'laps' => 52,
                'race_distance_km' => 306.198,
                'is_completed' => true,
                'is_active' => false,
            ],
            [
                'season_id' => $season2022->id,
                'circuit_id' => $monza->id,
                'round_number' => 16,
                'name' => 'Italian Grand Prix',
                'full_name' => 'Italian Grand Prix 2022',
                'official_name' => 'Formula 1 Pirelli Gran Premio d\'Italia 2022',
                'race_date' => '2022-09-11',
                'laps' => 53,
                'race_distance_km' => 306.720,
                'is_completed' => true,
                'is_active' => false,
            ],
        ];

        // Insert all races
        foreach ($races2024 as $race) {
            Race::create($race);
        }

        foreach ($races2023 as $race) {
            Race::create($race);
        }

        foreach ($races2022 as $race) {
            Race::create($race);
        }
    }
}

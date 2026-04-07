<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Season;

class SeasonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $seasons = [
            [
                'year' => 2024,
                'start_date' => '2024-03-02',
                'end_date' => '2024-12-08',
                'total_races' => 24,
                'completed_races' => 24,
                'description' => '2024 FIA Formula One World Championship',
                'is_active' => true,
            ],
            [
                'year' => 2023,
                'start_date' => '2023-03-05',
                'end_date' => '2023-11-26',
                'total_races' => 22,
                'completed_races' => 22,
                'description' => '2023 FIA Formula One World Championship',
                'is_active' => false,
            ],
            [
                'year' => 2022,
                'start_date' => '2022-03-20',
                'end_date' => '2022-11-20',
                'total_races' => 22,
                'completed_races' => 22,
                'description' => '2022 FIA Formula One World Championship',
                'is_active' => false,
            ],
        ];

        foreach ($seasons as $season) {
            Season::create($season);
        }
    }
}

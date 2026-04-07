<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Team;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $teams = [
            [
                'name' => 'Red Bull Racing',
                'full_name' => 'Oracle Red Bull Racing',
                'code' => 'RBR',
                'country' => 'Austria',
                'headquarters' => 'Milton Keynes, United Kingdom',
                'team_chief' => 'Christian Horner',
                'technical_chief' => 'Pierre Waché',
                'chassis' => 'RB20',
                'power_unit' => 'Honda RBPT',
                'founded_year' => '2005-01-01',
                'world_championships' => 6,
                'race_wins' => 117,
                'pole_positions' => 105,
                'fastest_laps' => 77,
                'podiums' => 254,
                'is_active' => true,
            ],
            [
                'name' => 'Ferrari',
                'full_name' => 'Scuderia Ferrari',
                'code' => 'FER',
                'country' => 'Italy',
                'headquarters' => 'Maranello, Italy',
                'team_chief' => 'Frédéric Vasseur',
                'technical_chief' => 'Enrico Cardile',
                'chassis' => 'SF-24',
                'power_unit' => 'Ferrari',
                'founded_year' => '1950-01-01',
                'world_championships' => 16,
                'race_wins' => 243,
                'pole_positions' => 247,
                'fastest_laps' => 263,
                'podiums' => 834,
                'is_active' => true,
            ],
            [
                'name' => 'Mercedes',
                'full_name' => 'Mercedes-AMG Petronas',
                'code' => 'MER',
                'country' => 'Germany',
                'headquarters' => 'Brackley, United Kingdom',
                'team_chief' => 'Toto Wolff',
                'technical_chief' => 'James Allison',
                'chassis' => 'W15',
                'power_unit' => 'Mercedes',
                'founded_year' => '2010-01-01',
                'world_championships' => 8,
                'race_wins' => 125,
                'pole_positions' => 136,
                'fastest_laps' => 94,
                'podiums' => 294,
                'is_active' => true,
            ],
            [
                'name' => 'McLaren',
                'full_name' => 'McLaren F1 Team',
                'code' => 'MCL',
                'country' => 'United Kingdom',
                'headquarters' => 'Woking, United Kingdom',
                'team_chief' => 'Zak Brown',
                'technical_chief' => 'Peter Prodromou',
                'chassis' => 'MCL38',
                'power_unit' => 'Mercedes',
                'founded_year' => '1966-01-01',
                'world_championships' => 8,
                'race_wins' => 183,
                'pole_positions' => 156,
                'fastest_laps' => 155,
                'podiums' => 511,
                'is_active' => true,
            ],
        ];

        foreach ($teams as $team) {
            Team::create($team);
        }
    }
}

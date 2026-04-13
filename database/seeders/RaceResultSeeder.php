<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Race;
use App\Models\Driver;
use App\Models\Team;
use App\Models\RaceResult;

class RaceResultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get key drivers
        $verstappen = Driver::where('code', 'VER')->first();
        $perez = Driver::where('code', 'PER')->first();
        $hamilton = Driver::where('code', 'HAM')->first();
        $russell = Driver::where('code', 'RUS')->first();
        $leclerc = Driver::where('code', 'LEC')->first();
        $sainz = Driver::where('code', 'SAI')->first();
        $norris = Driver::where('code', 'NOR')->first();
        $piastri = Driver::where('code', 'PIA')->first();
        $alonso = Driver::where('code', 'ALO')->first();

        // Get key teams
        $redbull = Team::where('code', 'RBR')->first();
        $mercedes = Team::where('code', 'MER')->first();
        $ferrari = Team::where('code', 'FER')->first();
        $mclaren = Team::where('code', 'MCL')->first();
        $aston = Team::where('code', 'AMR')->first();

        // Get races
        $bahrain2024 = Race::where('name', 'Bahrain Grand Prix')->where('race_date', '2024-03-02')->first();
        $british2024 = Race::where('name', 'British Grand Prix')->where('race_date', '2024-07-07')->first();
        $italian2024 = Race::where('name', 'Italian Grand Prix')->where('race_date', '2024-09-01')->first();
        
        $bahrain2023 = Race::where('name', 'Bahrain Grand Prix')->where('race_date', '2023-03-05')->first();
        $monaco2023 = Race::where('name', 'Monaco Grand Prix')->where('race_date', '2023-05-28')->first();
        $belgian2023 = Race::where('name', 'Belgian Grand Prix')->where('race_date', '2023-07-30')->first();
        
        $bahrain2022 = Race::where('name', 'Bahrain Grand Prix')->where('race_date', '2022-03-20')->first();
        $british2022 = Race::where('name', 'British Grand Prix')->where('race_date', '2022-07-03')->first();
        $italian2022 = Race::where('name', 'Italian Grand Prix')->where('race_date', '2022-09-11')->first();

        // 2024 Bahrain GP - Max Verstappen won
        if ($bahrain2024) {
            $results = [
                ['position' => 1, 'position_text' => '1', 'driver_id' => $verstappen->id, 'team_id' => $redbull->id, 'grid_position' => 1, 'laps_completed' => 57, 'points' => 25, 'status' => 'Finished', 'fastest_lap' => 1, 'fastest_lap_time' => '1:31.632'],
                ['position' => 2, 'position_text' => '2', 'driver_id' => $perez->id, 'team_id' => $redbull->id, 'grid_position' => 2, 'laps_completed' => 57, 'points' => 18, 'status' => 'Finished', 'fastest_lap' => 0],
                ['position' => 3, 'position_text' => '3', 'driver_id' => $leclerc->id, 'team_id' => $ferrari->id, 'grid_position' => 3, 'laps_completed' => 57, 'points' => 15, 'status' => 'Finished', 'fastest_lap' => 0],
                ['position' => 4, 'position_text' => '4', 'driver_id' => $sainz->id, 'team_id' => $ferrari->id, 'grid_position' => 4, 'laps_completed' => 57, 'points' => 12, 'status' => 'Finished', 'fastest_lap' => 0],
                ['position' => 5, 'position_text' => '5', 'driver_id' => $norris->id, 'team_id' => $mclaren->id, 'grid_position' => 5, 'laps_completed' => 57, 'points' => 10, 'status' => 'Finished', 'fastest_lap' => 0],
            ];
            
            foreach ($results as $result) {
                $result['race_id'] = $bahrain2024->id;
                RaceResult::create($result);
            }
        }

        // 2024 British GP - Lewis Hamilton won
        if ($british2024) {
            $results = [
                ['position' => 1, 'position_text' => '1', 'driver_id' => $hamilton->id, 'team_id' => $mercedes->id, 'grid_position' => 2, 'laps_completed' => 52, 'points' => 25, 'status' => 'Finished', 'fastest_lap' => 0],
                ['position' => 2, 'position_text' => '2', 'driver_id' => $verstappen->id, 'team_id' => $redbull->id, 'grid_position' => 1, 'laps_completed' => 52, 'points' => 18, 'status' => 'Finished', 'fastest_lap' => 1, 'fastest_lap_time' => '1:27.842'],
                ['position' => 3, 'position_text' => '3', 'driver_id' => $norris->id, 'team_id' => $mclaren->id, 'grid_position' => 4, 'laps_completed' => 52, 'points' => 15, 'status' => 'Finished', 'fastest_lap' => 0],
                ['position' => 4, 'position_text' => '4', 'driver_id' => $leclerc->id, 'team_id' => $ferrari->id, 'grid_position' => 3, 'laps_completed' => 52, 'points' => 12, 'status' => 'Finished', 'fastest_lap' => 0],
                ['position' => 5, 'position_text' => '5', 'driver_id' => $piastri->id, 'team_id' => $mclaren->id, 'grid_position' => 5, 'laps_completed' => 52, 'points' => 10, 'status' => 'Finished', 'fastest_lap' => 0],
            ];
            
            foreach ($results as $result) {
                $result['race_id'] = $british2024->id;
                RaceResult::create($result);
            }
        }

        // 2024 Italian GP - Oscar Piastri won
        if ($italian2024) {
            $results = [
                ['position' => 1, 'position_text' => '1', 'driver_id' => $piastri->id, 'team_id' => $mclaren->id, 'grid_position' => 2, 'laps_completed' => 53, 'points' => 25, 'status' => 'Finished', 'fastest_lap' => 0],
                ['position' => 2, 'position_text' => '2', 'driver_id' => $norris->id, 'team_id' => $mclaren->id, 'grid_position' => 1, 'laps_completed' => 53, 'points' => 18, 'status' => 'Finished', 'fastest_lap' => 0],
                ['position' => 3, 'position_text' => '3', 'driver_id' => $hamilton->id, 'team_id' => $mercedes->id, 'grid_position' => 3, 'laps_completed' => 53, 'points' => 15, 'status' => 'Finished', 'fastest_lap' => 0],
                ['position' => 4, 'position_text' => '4', 'driver_id' => $leclerc->id, 'team_id' => $ferrari->id, 'grid_position' => 4, 'laps_completed' => 53, 'points' => 12, 'status' => 'Finished', 'fastest_lap' => 1, 'fastest_lap_time' => '1:21.632'],
                ['position' => 5, 'position_text' => '5', 'driver_id' => $sainz->id, 'team_id' => $ferrari->id, 'grid_position' => 5, 'laps_completed' => 53, 'points' => 10, 'status' => 'Finished', 'fastest_lap' => 0],
            ];
            
            foreach ($results as $result) {
                $result['race_id'] = $italian2024->id;
                RaceResult::create($result);
            }
        }

        // 2023 Bahrain GP - Max Verstappen won
        if ($bahrain2023) {
            $results = [
                ['position' => 1, 'position_text' => '1', 'driver_id' => $verstappen->id, 'team_id' => $redbull->id, 'grid_position' => 1, 'laps_completed' => 57, 'points' => 25, 'status' => 'Finished', 'fastest_lap' => 1, 'fastest_lap_time' => '1:32.526'],
                ['position' => 2, 'position_text' => '2', 'driver_id' => $perez->id, 'team_id' => $redbull->id, 'grid_position' => 2, 'laps_completed' => 57, 'points' => 18, 'status' => 'Finished', 'fastest_lap' => 0],
                ['position' => 3, 'position_text' => '3', 'driver_id' => $alonso->id, 'team_id' => $aston->id, 'grid_position' => 5, 'laps_completed' => 57, 'points' => 15, 'status' => 'Finished', 'fastest_lap' => 0],
                ['position' => 4, 'position_text' => '4', 'driver_id' => $sainz->id, 'team_id' => $ferrari->id, 'grid_position' => 3, 'laps_completed' => 57, 'points' => 12, 'status' => 'Finished', 'fastest_lap' => 0],
                ['position' => 5, 'position_text' => '5', 'driver_id' => $hamilton->id, 'team_id' => $mercedes->id, 'grid_position' => 4, 'laps_completed' => 57, 'points' => 10, 'status' => 'Finished', 'fastest_lap' => 0],
            ];
            
            foreach ($results as $result) {
                $result['race_id'] = $bahrain2023->id;
                RaceResult::create($result);
            }
        }

        // 2023 Monaco GP - Max Verstappen won
        if ($monaco2023) {
            $results = [
                ['position' => 1, 'position_text' => '1', 'driver_id' => $verstappen->id, 'team_id' => $redbull->id, 'grid_position' => 1, 'laps_completed' => 78, 'points' => 25, 'status' => 'Finished', 'fastest_lap' => 0],
                ['position' => 2, 'position_text' => '2', 'driver_id' => $alonso->id, 'team_id' => $aston->id, 'grid_position' => 2, 'laps_completed' => 78, 'points' => 18, 'status' => 'Finished', 'fastest_lap' => 0],
                ['position' => 3, 'position_text' => '3', 'driver_id' => Driver::where('code', 'OCO')->first()->id, 'team_id' => Team::where('code', 'ALP')->first()->id, 'grid_position' => 3, 'laps_completed' => 78, 'points' => 15, 'status' => 'Finished', 'fastest_lap' => 0],
                ['position' => 4, 'position_text' => '4', 'driver_id' => $hamilton->id, 'team_id' => $mercedes->id, 'grid_position' => 4, 'laps_completed' => 78, 'points' => 12, 'status' => 'Finished', 'fastest_lap' => 0],
                ['position' => 5, 'position_text' => '5', 'driver_id' => Driver::where('code', 'GAS')->first()->id, 'team_id' => Team::where('code', 'ALP')->first()->id, 'grid_position' => 5, 'laps_completed' => 78, 'points' => 10, 'status' => 'Finished', 'fastest_lap' => 1, 'fastest_lap_time' => '1:15.262'],
            ];
            
            foreach ($results as $result) {
                $result['race_id'] = $monaco2023->id;
                RaceResult::create($result);
            }
        }

        // 2023 Belgian GP - Max Verstappen won
        if ($belgian2023) {
            $results = [
                ['position' => 1, 'position_text' => '1', 'driver_id' => $verstappen->id, 'team_id' => $redbull->id, 'grid_position' => 1, 'laps_completed' => 44, 'points' => 25, 'status' => 'Finished', 'fastest_lap' => 0],
                ['position' => 2, 'position_text' => '2', 'driver_id' => $perez->id, 'team_id' => $redbull->id, 'grid_position' => 2, 'laps_completed' => 44, 'points' => 18, 'status' => 'Finished', 'fastest_lap' => 0],
                ['position' => 3, 'position_text' => '3', 'driver_id' => $leclerc->id, 'team_id' => $ferrari->id, 'grid_position' => 3, 'laps_completed' => 44, 'points' => 15, 'status' => 'Finished', 'fastest_lap' => 1, 'fastest_lap_time' => '1:47.283'],
                ['position' => 4, 'position_text' => '4', 'driver_id' => $piastri->id, 'team_id' => $mclaren->id, 'grid_position' => 4, 'laps_completed' => 44, 'points' => 12, 'status' => 'Finished', 'fastest_lap' => 0],
                ['position' => 5, 'position_text' => '5', 'driver_id' => $alonso->id, 'team_id' => $aston->id, 'grid_position' => 5, 'laps_completed' => 44, 'points' => 10, 'status' => 'Finished', 'fastest_lap' => 0],
            ];
            
            foreach ($results as $result) {
                $result['race_id'] = $belgian2023->id;
                RaceResult::create($result);
            }
        }

        // 2022 Bahrain GP - Max Verstappen won
        if ($bahrain2022) {
            $results = [
                ['position' => 1, 'position_text' => '1', 'driver_id' => $verstappen->id, 'team_id' => $redbull->id, 'grid_position' => 1, 'laps_completed' => 57, 'points' => 25, 'status' => 'Finished', 'fastest_lap' => 1, 'fastest_lap_time' => '1:33.074'],
                ['position' => 2, 'position_text' => '2', 'driver_id' => $leclerc->id, 'team_id' => $ferrari->id, 'grid_position' => 2, 'laps_completed' => 57, 'points' => 18, 'status' => 'Finished', 'fastest_lap' => 0],
                ['position' => 3, 'position_text' => '3', 'driver_id' => $sainz->id, 'team_id' => $ferrari->id, 'grid_position' => 3, 'laps_completed' => 57, 'points' => 15, 'status' => 'Finished', 'fastest_lap' => 0],
                ['position' => 4, 'position_text' => '4', 'driver_id' => $hamilton->id, 'team_id' => $mercedes->id, 'grid_position' => 5, 'laps_completed' => 57, 'points' => 12, 'status' => 'Finished', 'fastest_lap' => 0],
                ['position' => 5, 'position_text' => '5', 'driver_id' => $russell->id, 'team_id' => $mercedes->id, 'grid_position' => 4, 'laps_completed' => 57, 'points' => 10, 'status' => 'Finished', 'fastest_lap' => 0],
            ];
            
            foreach ($results as $result) {
                $result['race_id'] = $bahrain2022->id;
                RaceResult::create($result);
            }
        }

        // 2022 British GP - Carlos Sainz won
        if ($british2022) {
            $results = [
                ['position' => 1, 'position_text' => '1', 'driver_id' => $sainz->id, 'team_id' => $ferrari->id, 'grid_position' => 3, 'laps_completed' => 52, 'points' => 25, 'status' => 'Finished', 'fastest_lap' => 0],
                ['position' => 2, 'position_text' => '2', 'driver_id' => $perez->id, 'team_id' => $redbull->id, 'grid_position' => 2, 'laps_completed' => 52, 'points' => 18, 'status' => 'Finished', 'fastest_lap' => 0],
                ['position' => 3, 'position_text' => '3', 'driver_id' => $hamilton->id, 'team_id' => $mercedes->id, 'grid_position' => 1, 'laps_completed' => 52, 'points' => 15, 'status' => 'Finished', 'fastest_lap' => 0],
                ['position' => 4, 'position_text' => '4', 'driver_id' => $leclerc->id, 'team_id' => $ferrari->id, 'grid_position' => 4, 'laps_completed' => 52, 'points' => 12, 'status' => 'Finished', 'fastest_lap' => 1, 'fastest_lap_time' => '1:28.367'],
                ['position' => 5, 'position_text' => '5', 'driver_id' => $russell->id, 'team_id' => $mercedes->id, 'grid_position' => 5, 'laps_completed' => 52, 'points' => 10, 'status' => 'Finished', 'fastest_lap' => 0],
            ];
            
            foreach ($results as $result) {
                $result['race_id'] = $british2022->id;
                RaceResult::create($result);
            }
        }

        // 2022 Italian GP - Max Verstappen won
        if ($italian2022) {
            $results = [
                ['position' => 1, 'position_text' => '1', 'driver_id' => $verstappen->id, 'team_id' => $redbull->id, 'grid_position' => 1, 'laps_completed' => 53, 'points' => 25, 'status' => 'Finished', 'fastest_lap' => 0],
                ['position' => 2, 'position_text' => '2', 'driver_id' => $perez->id, 'team_id' => $redbull->id, 'grid_position' => 2, 'laps_completed' => 53, 'points' => 18, 'status' => 'Finished', 'fastest_lap' => 0],
                ['position' => 3, 'position_text' => '3', 'driver_id' => $sainz->id, 'team_id' => $ferrari->id, 'grid_position' => 3, 'laps_completed' => 53, 'points' => 15, 'status' => 'Finished', 'fastest_lap' => 0],
                ['position' => 4, 'position_text' => '4', 'driver_id' => $leclerc->id, 'team_id' => $ferrari->id, 'grid_position' => 4, 'laps_completed' => 53, 'points' => 12, 'status' => 'Finished', 'fastest_lap' => 1, 'fastest_lap_time' => '1:21.669'],
                ['position' => 5, 'position_text' => '5', 'driver_id' => $russell->id, 'team_id' => $mercedes->id, 'grid_position' => 5, 'laps_completed' => 53, 'points' => 10, 'status' => 'Finished', 'fastest_lap' => 0],
            ];
            
            foreach ($results as $result) {
                $result['race_id'] = $italian2022->id;
                RaceResult::create($result);
            }
        }
    }
}

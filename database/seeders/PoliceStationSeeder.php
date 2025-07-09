<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PoliceStationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stations = [
            'Bilimora',
            'Chikhli',
            'Cyber Crime',
            'Dholai Marine',
            'Gandevi',
            'Jalalpore',
            'Khergam',
            'Maroli',
            'Navsari Rural',
            'Navsari Town',
            'Vansda',
            'Vijalpore',
        ];

        foreach ($stations as $station) {
            \App\Models\PoliceStation::create([
                'name' => $station,
                'pi_name' => null,
                'pi_sign' => null,
                'seal' => null,
                'address' => null,
            ]);
        }
    }
}

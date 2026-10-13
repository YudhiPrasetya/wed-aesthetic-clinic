<?php

namespace Database\Seeders;

use App\Models\ServiceSchedule;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $servicesSchdules = [
            ['service_id' => 1, 'hours' => '09:00', 'quota' => 3],
            ['service_id' => 1, 'hours' => '11:00', 'quota' => 3],
            ['service_id' => 1, 'hours' => '13:00', 'quota' => 3],
            ['service_id' => 1, 'hours' => '15:00', 'quota' => 3],
            ['service_id' => 1, 'hours' => '17:00', 'quota' => 3],
            ['service_id' => 1, 'hours' => '19:00', 'quota' => 3],

            ['service_id' => 2, 'hours' => '09:00', 'quota' => 3],
            ['service_id' => 2, 'hours' => '11:00', 'quota' => 3],
            ['service_id' => 2, 'hours' => '13:00', 'quota' => 3],
            ['service_id' => 2, 'hours' => '15:00', 'quota' => 3],
            ['service_id' => 2, 'hours' => '17:00', 'quota' => 3],
            ['service_id' => 2, 'hours' => '19:00', 'quota' => 3],

            ['service_id' => 3, 'hours' => '09:00', 'quota' => 3],
            ['service_id' => 3, 'hours' => '11:00', 'quota' => 3],
            ['service_id' => 3, 'hours' => '13:00', 'quota' => 3],
            ['service_id' => 3, 'hours' => '15:00', 'quota' => 3],
            ['service_id' => 3, 'hours' => '17:00', 'quota' => 3],
            ['service_id' => 3, 'hours' => '19:00', 'quota' => 3],

            ['service_id' => 4, 'hours' => '09:00', 'quota' => 3],
            ['service_id' => 4, 'hours' => '11:00', 'quota' => 3],
            ['service_id' => 4, 'hours' => '13:00', 'quota' => 3],
            ['service_id' => 4, 'hours' => '15:00', 'quota' => 3],
            ['service_id' => 4, 'hours' => '17:00', 'quota' => 3],
            ['service_id' => 4, 'hours' => '19:00', 'quota' => 3],
        ];
        foreach($servicesSchdules as $sS){
            ServiceSchedule::firstOrCreate($sS);
        }
    }
}

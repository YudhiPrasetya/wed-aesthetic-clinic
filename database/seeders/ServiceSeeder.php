<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $services = [
            ['name' => 'Radiance Beauty Laser', 'description' => 'Menghilangkan flek dan mengencangkan kulit.', 'price' => 500000, 'duration_minutes' => 60, 'daily_quotas' => 6],
            ['name' => 'Lhala Peel', 'description' => 'Mencerahkan & mencegah penuaan dini.', 'price' => 1500000, 'duration_minutes' => 30, 'daily_quotas' => 6],
            ['name' => 'Skin Booster Glutanex Glow', 'description' => 'Melembabkan dan mencegah penuaan.', 'price' => 1000000, 'duration_minutes' => 45, 'daily_quotas' => 6],
            ['name' => 'Skin Booster NCTF 135 HA', 'description' => 'Mencerahkan dan memperbaiki tekstur kulit.', 'price' => 800000, 'duration_minutes' => 50, 'daily_quotas' => 6],
            ['name' => 'Konsultasi', 'description' => 'Konsultasi kesehatan kulit.', 'price' => 0, 'duration_minutes' => 10, 'daily_quotas' => 0],
        ];

        foreach ($services as $service) {
            \App\Models\Service::firstOrCreate($service);
        }
    }
}

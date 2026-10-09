<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DoctorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctors = [
            ['id' => 1, 'user_id' => 1,'full_name' => 'dr. Fitria Nada', 'role' => 'Dokter Estetika', 'specialization' => 'Dokter Umum', 'image' => 'drFitri.jpg', 'description' => 'Dokter umum dengan pengalaman 10 tahun di bidang kesehatan.', 'email' => 'fitria@gmail.com', 'phone' => '081234567890'],
            ['id' => 2, 'user_id' => 2, 'full_name' => 'dr. Ovi Rizky A', 'role' => 'Dokter Estetika', 'specialization' => 'Dokter Umum', 'image' => 'drOvi.jpg', 'description' => 'Dokter umum dengan pengalaman 10 tahun di bidang kesehatan.', 'email' => 'ovi@gmail.com', 'phone' => '081234567890'],
            ['user_id' => null, 'full_name' => 'dr. Rizka Aulia', 'role' => 'Aesthetic Expert', 'specialization' => 'Dokter Umum', 'image' => 'drRizka.jpg', 'description' => 'Dokter umum dengan pengalaman 10 tahun di bidang kesehatan.', 'email' => 'rizka@gmail.com', 'phone' => '081234567890'],

        ];
        foreach($doctors as $doctor) {
            \App\Models\Doctor::firstOrCreate($doctor);
        }
    }
}

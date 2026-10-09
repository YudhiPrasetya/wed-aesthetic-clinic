<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class DoctorUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $doctorUsers = [
            ['name' => 'dr. Fitria Nada', 'username' => 'Fitria', 'email' => 'fitria@gmail.com', 'email_verified_at' => \Carbon\Carbon::now('Asia/Jakarta'), 'password' => bcrypt('fitra123')],
            ['name' => 'dr. Ovi Rizky A', 'username' => 'Ovi', 'email' => 'ovi@gmail.com', 'email_verified_at' => \Carbon\Carbon::now('Asia/Jakarta'), 'password' => bcrypt('ovi123')]
        ];
        $permissions = Permission::where('name', 'like', 'Booking%')->get();
        $role = Role::firstOrCreate(['name' => 'doctor']);
        $role->syncPermissions($permissions);
        foreach($doctorUsers as $user){
            $newUser = User::firstOrCreate($user);
            if($newUser){
                $newUser->assignRole($role);
            }
        }

    }
}

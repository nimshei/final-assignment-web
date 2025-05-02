<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Insert users into the database
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@app.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Officer',
                'email' => 'officer@app.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'User',
                'email' => 'user@app.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'කුමාර සන්ජීව',
                'email' => 'kumara@app.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'සන්ජීව නිමල්',
                'email' => 'sanjeewa@app.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'නිමල් සමන්',
                'email' => 'nimal@app.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'සමන් ගාමිණී',
                'email' => 'saman@app.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ගාමිණී රුවන්',
                'email' => 'gamini@app.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'රුවන් අනුර',
                'email' => 'ruwan@app.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'අනුර ජගත්',
                'email' => 'anura@app.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ජගත් මහේෂ්',
                'email' => 'jagath@app.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'මහේෂ් කුමාර',
                'email' => 'mahesha@app.com',
                'password' => Hash::make('password'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Assign roles to users
        $adminUser = \App\Models\User::where('email', 'admin@app.com')->first();
        if ($adminUser) {
            $adminUser->assignRole(Role::where('name', 'Admin')->first());
        }

        $officerUser = \App\Models\User::where('email', 'officer@app.com')->first();
        if ($officerUser) {
            $officerUser->assignRole(Role::where('name', 'Officer')->first());
        }

        $regularUser = \App\Models\User::where('email', 'user@app.com')->first();
        if ($regularUser) {
            $regularUser->assignRole(Role::where('name', 'User')->first());
        }

        $sinhalaUsers = ['kumara', 'sanjeewa', 'nimal', 'saman', 'gamini', 'ruwan', 'anura', 'jagath', 'mahesha'];
        foreach ($sinhalaUsers as $emailPrefix) {
            $user = \App\Models\User::where('email', "$emailPrefix@app.com")->first();
            if ($user) {
                $user->assignRole(Role::where('name', 'User')->first());
            }
        }
    }
}

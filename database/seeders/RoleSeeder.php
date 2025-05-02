<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the roles you want to seed
        $roles = [
            'Admin',
            'User',
            'Officer',
        ];

        // Loop through and create each role
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }
    }
}

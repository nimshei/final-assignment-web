<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            PermissionSeeder::class,
            UserSeeder::class,
            LicenseSeeder::class,
            VehicleSeeder::class,
            RevenueLicenseSeeder::class,
            ViolationSeeder::class,
            OfficerSeeder::class,
            OffenceSeeder::class,
            AccidentSeeder::class,
            AccidentVehicleSeeder::class,
        ]);
    }
}

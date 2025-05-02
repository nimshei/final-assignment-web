<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Vehicle;
use Faker\Factory as Faker;

class RevenueLicenseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        $vehicles = Vehicle::all();

        foreach ($vehicles as $vehicle) {
            DB::table('revenue_licenses')->updateOrInsert(
                [
                    'vehicle_id' => $vehicle->id,
                ],
                [
                    'issue_date' => $faker->dateTimeBetween('-1 year', 'now'),
                    'expiry_date' => $faker->dateTimeBetween('now', '+1 year'),
                    'fee_paid' => $faker->randomFloat(2, 100, 1000),
                ]
            );
        }
    }
}

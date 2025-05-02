<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AccidentVehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $accidentIds = DB::table('accidents')->pluck('id')->toArray();
        $vehicleIds = DB::table('vehicles')->pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            DB::table('accident_vehicle')->insert([
                'accident_id' => $faker->randomElement($accidentIds),
                'vehicle_id' => $faker->randomElement($vehicleIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

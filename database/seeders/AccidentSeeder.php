<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class AccidentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Retrieve all officer IDs from the officers table
        $officerIds = DB::table('officers')->pluck('id')->toArray();
        $latitude = $faker->latitude(5.916, 9.842); // Latitude range for Sri Lanka
        $longitude = $faker->longitude(79.695, 81.881); // Longitude range for Sri Lanka


        foreach (range(1, 10) as $index) {
            DB::table('accidents')->insert([
                'officer_id' => $faker->randomElement($officerIds), // Get a random officer ID
                'accident_date_time' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i'),
                'location' => "{$latitude},{$longitude}",
                'description' => $faker->sentence,
                'severity' => $faker->randomElement(['Minor', 'Moderate', 'Severe', 'Fatal']),
                'injuries' => $faker->numberBetween(0, 10),
                'fatalities' => $faker->numberBetween(0, 5),
                'property_damage' => $faker->randomFloat(2, 0, 10000),
                'status' => $faker->randomElement(['Pending', 'Investigating', 'Resolved', 'Closed']),
                'notes' => $faker->paragraph,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

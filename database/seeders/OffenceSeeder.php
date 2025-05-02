<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Carbon\Carbon;

class OffenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            $latitude = $faker->latitude(5.916, 9.842); // Latitude range for Sri Lanka
            $longitude = $faker->longitude(79.695, 81.881); // Longitude range for Sri Lanka

            DB::table('offences')->insert([
                'license_id' => DB::table('licenses')->inRandomOrder()->value('id') ?? optional(DB::table('licenses')->first())->id,
                'officer_id' => DB::table('officers')->inRandomOrder()->value('id') ?? optional(DB::table('officers')->first())->id,
                'vehicle_id' => DB::table('vehicles')->inRandomOrder()->value('id') ?? optional(DB::table('vehicles')->first())->id,
                'violation_id' => DB::table('violations')->inRandomOrder()->value('id') ?? optional(DB::table('violations')->first())->id,
                'date_time' => Carbon::instance($faker->dateTimeThisYear())->format('Y-m-d H:i:00'),
                'location' => "{$latitude},{$longitude}",
                'description' => $faker->sentence,
                'fine_amount' => $faker->randomFloat(2, 50, 500),
                'court_date' => $faker->optional()->dateTimeThisYear('+1 month') ? Carbon::instance($faker->dateTimeThisYear('+1 month'))->format('Y-m-d H:i:00') : null,
                'deadline' => $faker->optional()->dateTimeThisYear('+2 months') ? Carbon::instance($faker->dateTimeThisYear('+2 months'))->format('Y-m-d H:i:00') : null,
                'status' => $faker->randomElement(['Pending', 'Warning', 'Paid', 'Court']),
                'created_at' => Carbon::now()->format('Y-m-d H:i:00'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:00'),
            ]);
        }
    }
}

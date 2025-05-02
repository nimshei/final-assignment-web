<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class OfficerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        foreach (range(1, 10) as $index) {
            DB::table('officers')->insert([
                'user_id' => $index,
                'name' => $faker->name,
                'badge_number' => $faker->unique()->numerify('#####'),
                'rank' => $faker->randomElement(['Sergeant', 'Inspector', 'Lieutenant']),
                'station' => $faker->city . ' Station',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}

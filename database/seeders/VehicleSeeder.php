<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            $vehicle = [
                'plate_number' => strtoupper($faker->bothify('???####')),
                'make' => $faker->randomElement(['Toyota', 'Honda', 'Ford', 'Nissan', 'BMW']),
                'model' => $faker->word(),
                'color' => $faker->safeColorName(),
                'owner_nic' => $faker->regexify('[0-9]{9}[Vv]'),
                'owner_name' => $faker->name(),
                'owner_contact' => $faker->phoneNumber(),
                'chassis_number' => $faker->regexify('[A-HJ-NPR-Z0-9]{17}'),
                'engine_number' => $faker->regexify('EN[0-9]{9}'),
                'vehicle_type' => $faker->randomElement(['Sedan', 'SUV', 'Truck', 'Van', 'Coupe']),
                'year_of_manufacture' => $faker->numberBetween(2000, 2023),
                'created_at' => now(),
                'updated_at' => now(),
            ];

            DB::table('vehicles')->updateOrInsert(
                [
                    'plate_number' => $vehicle['plate_number'],
                    'chassis_number' => $vehicle['chassis_number'],
                    'engine_number' => $vehicle['engine_number'],
                ],
                $vehicle
            );
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\License;
use App\Models\User;
use Illuminate\Support\Str;

class LicenseSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            if (!$user->license) {
                License::create([
                    'user_id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'license_number' => strtoupper(fake()->bothify('??######??')),
                    'issue_date' => fake()->dateTimeBetween('-5 years', 'now'),
                    'expiry_date' => fake()->dateTimeBetween('now', '+5 years'),
                    'id_type' => fake()->randomElement(['National ID', 'Passport', 'Driving License']),
                    'id_number' => match (fake()->randomElement(['National ID', 'Passport', 'Driving License'])) {
                        'National ID' => strtoupper(fake()->bothify('#########V')),
                        'Passport' => strtoupper(fake()->bothify('??########')),
                        'Driving License' => strtoupper(fake()->bothify('D########')),
                    },
                    'date_of_birth' => fake()->dateTimeBetween('-60 years', '-18 years')->format('Y-m-d'),
                    'age' => fake()->numberBetween(18, 60),
                    'sex' => fake()->randomElement(['Male', 'Female']),
                    'permanent_address' => fake()->randomElement([
                        'No. 123, Galle Road, Colombo 03',
                        'No. 45, Kandy Road, Peradeniya',
                        'No. 78, Main Street, Jaffna',
                        'No. 56, Temple Road, Anuradhapura',
                        'No. 89, Beach Road, Matara',
                        'No. 34, Lake Road, Nuwara Eliya',
                        'No. 12, Fort Road, Galle',
                        'No. 67, Station Road, Negombo',
                        'No. 23, Hill Street, Ratnapura',
                        'No. 90, Market Road, Kurunegala',
                    ]),
                    'phone_number' => fake()->numerify('07#########'),
                    'divisional_secretariat_code' => fake()->randomElement(['1001', '1002', '1003', '1004', '1005']),
                    'blood_group' => fake()->randomElement(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+', 'AB-']),
                    'organ_donor_status' => fake()->boolean(),
                    'height' => fake()->randomFloat(1, 4.5, 6.5),
                    'active_status' => fake()->boolean(),
                ]);
            }
        }
    }
}
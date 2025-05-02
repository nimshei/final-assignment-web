<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ViolationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        $violationData = [
            [
                'violation_name' => 'Speeding',
                'description' => 'වේගය ඉක්මවා යාම'
            ],
            [
                'violation_name' => 'Illegal Parking',
                'description' => 'නීති විරෝධී වාහන නවතා තැබීම'
            ],
            [
                'violation_name' => 'Driving Without a License',
                'description' => 'රියදුරු බලපත්‍රයකින් තොරව රිය ධාවනය කිරීම'
            ],
            [
                'violation_name' => 'Reckless Driving',
                'description' => 'නැඹුරු නොවන ලෙස රිය ධාවනය කිරීම'
            ],
            [
                'violation_name' => 'Failure to Yield',
                'description' => 'අනෙක් වාහනවලට මාර්ගය ලබා නොදීම'
            ],
            [
                'violation_name' => 'Driving Under Influence',
                'description' => 'මත්පැන් හෝ මත්ද්‍රව්‍ය බලපෑමෙන් රිය ධාවනය කිරීම'
            ],
            [
                'violation_name' => 'Using Mobile While Driving',
                'description' => 'රිය ධාවනය කිරීමේදී ජංගම දුරකථනය භාවිතා කිරීම'
            ],
            [
                'violation_name' => 'Not Wearing a Seatbelt',
                'description' => 'ආරක්ෂිත බෙල්ට් නොධාරණය කිරීම'
            ],
            [
                'violation_name' => 'Expired Vehicle Registration',
                'description' => 'කල් ඉකුත් වූ වාහන ලියාපදිංචිය'
            ],
            [
                'violation_name' => 'Overloading Vehicle',
                'description' => 'වාහනයේ උපරිම බර ඉක්මවා පූරණය කිරීම'
            ],
            [
                'violation_name' => 'Driving Without Insurance',
                'description' => 'රක්ෂණය නොමැතිව රිය ධාවනය කිරීම'
            ],
            [
                'violation_name' => 'Tampering with License Plates',
                'description' => 'නැමුණු ලයිසන්සියන් පුවරු වෙනස් කිරීම'
            ],
            [
                'violation_name' => 'Driving an Unroadworthy Vehicle',
                'description' => 'මාර්ගයට අසුබල වාහනයක් රියදැවීම'
            ],
            [
                'violation_name' => 'Unauthorized Vehicle Modifications',
                'description' => 'අනවසරයෙන් වාහන සංශෝධන කිරීම'
            ]
        ];
        
        foreach ($violationData as $violation) {
            DB::table('violations')->insert([
                'violation_code' => strtoupper($faker->bothify('VIO###')),
                'violation_name' => $violation['violation_name'],
                'description' => $violation['description'],
                'fine_amount' => $faker->randomFloat(2, 50, 1000),
                'penalty' => $faker->randomElement([10, 20, 30, 40, 50]),
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
        
    }
}

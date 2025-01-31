<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class DoctorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 5; $i++) {
            DB::table('doctors')->insert([
                'name' => $faker->name,
                'specialization' => $faker->word, // Bisa diganti dengan daftar spesialis tertentu
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PolySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $polies = [
            ['name' => 'general'],
            ['name' => 'dentist'],
            ['name' => 'otolaryngology'],
            ['name' => 'pediatrics'],
            ['name' => 'obgyn'],
            ['name' => 'surgery'],
            ['name' => 'cardiology'],
            ['name' => 'neurology'],
            ['name' => 'dermatology and venerology'],
            ['name' => 'ophthalmology'],
            ['name' => 'respiratory'],
            ['name' => 'nutrition'],
            ['name' => 'psychiatry'],
            ['name' => 'orthopedic'],
            ['name' => 'urology'],
            ['name' => 'internal medic'],
            ['name' => 'therapy'],
            ['name' => 'geriatrics'],
            ['name' => 'endocrinology'],
            ['name' => 'hemodialysis'],
        ];

        DB::table('polies')->insert($polies);
    }
}

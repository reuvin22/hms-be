<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            GrantSeeder::class,
            PermissionSeeder::class,
            ModuleSeeder::class,
            PersonalInfoSeeder::class,
            SymptomSeeder::class,
            IdentitySeeder::class,
            DOHPositionSeeder::class,
            DOHICD10Seeder::class,
            DOHSurgerySeeder::class,
            PathologySeeder::class,
            PatientImgResultSeeder::class,
            BedSeeder::class
        ]);
    }
}

<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ModuleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $path = base_path('database/seeders/sql/module-data.sql');
        DB::unprepared(file_get_contents($path));
        $this->command->info('Module data seeded!');
    }
}

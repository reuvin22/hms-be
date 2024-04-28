<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DOHReportAnnualSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = base_path('database/seeders/sql/doh-annual-report-data.sql');
        DB::unprepared(file_get_contents($path));
        $this->command->info('annual-report data seeded!');
    }
}

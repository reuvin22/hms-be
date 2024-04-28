<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InventoryIssue extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = base_path('database/seeders/sql/inventory-issue.sql');
        DB::unprepared(file_get_contents($path));
        $this->command->info('Inventory Issue data seeded!');
    }
}

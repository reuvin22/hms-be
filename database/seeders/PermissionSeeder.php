<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = base_path('database/seeders/sql/permission-data.sql');

        $tableName = 'permissions';
        foreach (file($path) as $line) {
            if(preg_match('/INSERT INTO (\w+)/i', $line, $matches)) {
                $tableName = $matches[1];
                break;
            }
        }

        if($tableName) {
            DB::table($tableName)->delete();

            DB::statement("TRUNCATE TABLE $tableName");

            DB::unprepared(file_get_contents($path));
            $this->command->info("Permission data seeded!");
        } else {
            $this->command->error("Failed to determine table name from SQL file.");
        }
    }
}

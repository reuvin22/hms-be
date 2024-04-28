<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DOHICD10Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $path = base_path('database/seeders/sql/doh-icd10-data.sql');
        DB::unprepared(file_get_contents($path));
        $this->command->info('ICD10 data seeded!');

        $path = base_path('database/seeders/sql/doh-icd10-data.sql');

        $tableName = 'doh_icd10';
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
            $this->command->info("ICD10 data seeded!");
        } else {
            $this->command->error("Failed to determine table name from SQL file.");
        }
    }
}

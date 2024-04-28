<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bed_floors', function (Blueprint $table) {
            $table->id();
            $table->string('floor');
            $table->string('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('bed_groups', function (Blueprint $table) {
        //     $table->dropForeign(['floor_id']); // Drop the foreign key constraint
        // });
        Schema::dropIfExists('bed_floors');
    }
};

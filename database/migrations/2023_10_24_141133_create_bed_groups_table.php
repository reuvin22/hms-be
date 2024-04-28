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
        Schema::create('bed_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name', 15);
            $table->string('description')->nullable();
            $table->integer('floor_id');
            $table->boolean('is_active')->default(1);
            $table->timestamps();

            // $table->foreign('floor_id')->references('id')->on('bed_floors');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('bed_lists', function (Blueprint $table) {
        //     $table->dropForeign(['bed_group_id']); // Drop the foreign key constraint
        // });
        Schema::dropIfExists('bed_groups');
    }
};

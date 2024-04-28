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
        Schema::create('bed_lists', function (Blueprint $table) {
            $table->id();
            $table->string('name', 10);
            $table->integer('bed_type_id');
            $table->integer('bed_group_id');
            $table->boolean('is_active')->default(1);
            $table->string('availability')->nullable();
            $table->timestamps();

            // $table->foreign('bed_type_id')->references('id')->on('bed_types');
            // $table->foreign('bed_group_id')->references('id')->on('bed_groups');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bed_lists');
    }
};

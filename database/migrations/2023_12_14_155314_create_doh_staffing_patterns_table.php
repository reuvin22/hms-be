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
        Schema::create('doh_staffing_patterns', function (Blueprint $table) {
            $table->id();
            $table->integer('profession_designation')->nullable();
            $table->integer('specialty_board_certified')->nullable();
            $table->integer('fulltime_40permament')->nullable();
            $table->integer('fulltime_40contructual')->nullable();
            $table->integer('parttime_permanent')->nullable();
            $table->integer('parttime_contructual')->nullable();
            $table->integer('active_rotating_affiliate')->nullable();
            $table->integer('outsourced')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doh_staffing_patterns');
    }
};

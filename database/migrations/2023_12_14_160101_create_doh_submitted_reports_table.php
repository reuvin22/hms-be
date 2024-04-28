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
        Schema::create('doh_submitted_reports', function (Blueprint $table) {
            $table->id();
            $table->integer('reporting_year')->nullable();
            $table->string('reporting_status', 1)->nullable();
            $table->string('reported_by')->nullable();
            $table->string('designation')->nullable();
            $table->string('section')->nullable();
            $table->string('department')->nullable();
            $table->dateTime('date_reported')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doh_submitted_reports');
    }
};

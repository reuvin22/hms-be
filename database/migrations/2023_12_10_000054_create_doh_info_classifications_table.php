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
        Schema::create('doh_info_classifications', function (Blueprint $table) {
            $table->id();
            $table->integer('service_capability_id')->nullable();
            $table->integer('general_id')->nullable();
            $table->integer('specialty_id')->nullable();
            $table->string('specialty_specify')->nullable();
            $table->integer('trauma_capability_id')->nullable();
            $table->integer('nature_of_ownership_id')->nullable();
            $table->integer('government_id')->nullable();
            $table->integer('national_id')->nullable();
            $table->integer('local_id')->nullable();
            $table->integer('private_id')->nullable();
            $table->string('ownership_other')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doh_info_classifications');
    }
};

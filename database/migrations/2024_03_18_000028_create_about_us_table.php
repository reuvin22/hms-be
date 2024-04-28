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
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->string('hci_name')->nullable();
            $table->string('accreditation_no')->nullable();
            $table->string('province')->nullable();
            $table->string('province_name')->nullable();
            $table->string('city')->nullable();
            $table->string('city_name')->nullable();
            $table->string('municipality')->nullable();
            $table->string('municipality_name')->nullable();
            $table->string('barangay')->nullable();
            $table->string('barangay_name')->nullable();
            $table->string('street')->nullable();
            $table->string('subdivision_village')->nullable();
            $table->string('building_no')->nullable();
            $table->string('blk')->nullable();
            $table->integer('postal_code')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};

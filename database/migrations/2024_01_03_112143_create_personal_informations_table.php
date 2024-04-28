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
        Schema::create('personal_informations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('personal_id', 15);
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('suffix', 5)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('gender',6)->nullable();
            $table->string('civil_status', 10)->nullable();
            $table->string('contact_no', 15)->nullable();
            $table->string('telephone_no', 15)->nullable();
            $table->string('email')->nullable();
            $table->integer('age')->nullable();
            $table->string('province')->nullable();
            $table->string('city_of')->nullable();
            $table->string('municipality')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('barangay')->nullable();
            $table->string('subdivision_village')->nullable();
            $table->string('street')->nullable();
            $table->string('no_blk_lot')->nullable();
            $table->string('nationality')->nullable();
            $table->string('religion')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_address')->nullable();
            $table->string('father_contact')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('mother_address')->nullable();
            $table->string('mother_contact')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('spouse_address')->nullable();
            $table->string('spouse_contact')->nullable();
            $table->string('occupation')->nullable();
            $table->string('employer_name')->nullable();
            $table->string('employer_address')->nullable();
            $table->string('employer_contact')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_informations');
    }
};

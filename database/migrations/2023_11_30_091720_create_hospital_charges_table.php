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
        Schema::create('hospital_charges', function (Blueprint $table) {
            $table->id();
            $table->integer('charge_type_id');
            $table->integer('charge_category_id');
            $table->string('code');
            $table->integer('standard_charge');
            $table->boolean('is_active')->default(1);
            $table->timestamps();

            
            $table->foreign('charge_type_id')->references('id')->on('hospital_charge_types');
            $table->foreign('charge_category_id')->references('id')->on('hospital_charge_categories');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hospital_charges');
    }
};

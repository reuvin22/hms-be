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
        Schema::create('patient_ivfluids', function (Blueprint $table) {
            $table->id();
            $table->string('patient_id', 15);
            $table->string('nurse_id', 15);
            $table->string('bottle_no');
            $table->string('type_of_iv');
            $table->string('volume');
            $table->string('rate_of_flow');
            $table->dateTime('datetime_start');
            $table->dateTime('datetime_end');
            $table->string('nurse_on_duty', 15)->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_ivfluids');
    }
};

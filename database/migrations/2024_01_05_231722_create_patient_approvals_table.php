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
        Schema::create('patient_approvals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('patient_info_id');
            $table->string('admitting_clerk', 15);
            $table->string('admitting_physician', 15);
            $table->string('patient_id', 15);
            $table->string('type_approval', 20)->nullable();
            $table->string('is_approved')->default("Pending");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient_approvals');
    }
};

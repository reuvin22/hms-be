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
        Schema::create('doh_info_quality_mgmts', function (Blueprint $table) {
            $table->id();
            $table->integer('quality_mgmt_type_id')->nullable();
            $table->text('description')->nullable();
            $table->string('certifying_body')->nullable();
            $table->integer('philhealth_accreditation_id')->nullable();
            $table->date('validity_from')->nullable();
            $table->date('validity_to')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doh_info_quality_mgmts');
    }
};

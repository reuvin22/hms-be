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
        Schema::create('employment_informations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id',15)->nullable();
            $table->date('date_hired')->nullable();
            $table->integer('profession_designation_id')->nullable();
            $table->integer('specialty_board_cert_id')->nullable();
            $table->integer('fulltime_40permanent')->default(0);
            $table->integer('fulltime_40contructual')->default(0);
            $table->integer('parttime_permanent')->default(0);
            $table->integer('parttime_contructual')->default(0);
            $table->integer('active_rotating_affil')->default(0);
            $table->integer('outsourced')->default(0);
            $table->string('employer_name')->nullable();
            $table->string('employer_address')->nullable();
            $table->string('employer_contract')->nullable();
            $table->date('employer_from')->nullable();
            $table->date('employer_to')->nullable();
            $table->string('position')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employment_informations');
    }
};

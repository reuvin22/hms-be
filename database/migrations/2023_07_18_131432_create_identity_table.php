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
        Schema::create('identity', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id', 15);
            $table->date('date_hired')->nullable();
            $table->string('type_visit')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('suffix', 5)->nullable();
            $table->integer('age')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('gender',6)->nullable();
            $table->string('civil_status', 10)->nullable();
            $table->string('contact_no', 15)->nullable();
            // part II
            $table->string('country')->nullable();
            $table->string('province')->nullable();
            $table->string('state_municipality')->nullable();
            $table->string('barangay')->nullable();
            $table->string('street',5)->nullable();
            $table->string('no_blk_lot',5)->nullable();
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
            
            // employment details
            $table->string('occupation')->nullable();
            $table->string('employer_name')->nullable();
            $table->string('employer_address')->nullable();
            $table->string('employer_contact')->nullable();
            $table->string('tin_no', 20)->nullable();
            $table->string('philhealth_no', 20)->nullable();
            $table->string('sss_no', 20)->nullable();
            $table->string('pagibig_no', 20)->nullable();
            $table->string('hmo_no', 20)->nullable();
            // professional details
            $table->string('prc_no', 20)->nullable();
            $table->date('prc_date_issued')->nullable();
            $table->date('prc_date_expire')->nullable();
            // $table->string('tax_code', 20)->nullable();
            // $table->string('tax_excemption_code', 20)->nullable();
            // $table->string('payment_type', 20)->nullable();
            // $table->string('bank_account_code', 20)->nullable();
            // $table->string('bank_account_no', 20)->nullable();
            // admin details
            // $table->string('approver', 20)->nullable();
            // $table->string('batch_id', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('identity');
    }
};

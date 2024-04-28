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
        Schema::create('doh_surgeries', function (Blueprint $table) {
            $table->id();
            $table->string('proc_code')->nullable();
            $table->text('proc_desc')->nullable();
            $table->string('opty_code')->nullable(); 
            $table->string('prot_code')->nullable(); 
            $table->string('proc_uval')->nullable(); 
            $table->string('proc_rem')->nullable(); 
            $table->string('proc_stat',1)->nullable(); 
            $table->string('pro_clock',1)->nullable(); 
            $table->string('date_mod')->nullable(); 
            $table->string('up_dsw',1)->nulllable(); 
            $table->string('altp_code',10)->nullable(); 
            $table->string('altp_desc')->nullable(); 
            $table->string('pri_den')->nullable(); 
            $table->string('prm_apto')->nullable(); 
            $table->string('pr_sect')->nullable(); 
            $table->string('pr_vfa')->nullable(); 
            $table->string('pr_detsec')->nullable(); 
            $table->string('pr_regn')->nullable(); 
            $table->string('pr_extyp')->nullable(); 
            $table->string('pr_speco')->nullable(); 
            $table->string('cost_center')->nullable(); 
            $table->string('proc_reslt')->nullable(); 
            $table->string('rvu')->nullable(); 
            $table->string('res_template')->nullable();
            $table->string('priority')->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doh_surgeries');
    }
};

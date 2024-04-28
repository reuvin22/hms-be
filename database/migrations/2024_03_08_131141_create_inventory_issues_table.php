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
        Schema::create('inventory_issues', function (Blueprint $table) {
            $table->id();
            $table->integer('usert_type_id');
            $table->integer('status_id');
            $table->string('issue_to');
            $table->string('issue_by');
            $table->date('issue_date');
            $table->date('return_date');
            $table->string('note');
            $table->integer('category_id');
            $table->integer('item_id');
            $table->integer('qty');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventory_issues');
    }
};

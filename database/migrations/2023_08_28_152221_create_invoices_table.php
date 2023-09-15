<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('job_id');
            $table->string('status')->default('unpaid');
            $table->string('drive_time');
            $table->string('labor_time');
            $table->string('payments_and_deposits_input');
            $table->string('amount_description');
            $table->string('amount');
            $table->string('note_to_cust');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};

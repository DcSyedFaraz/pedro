<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('job_invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('jobs_id')->constrained()->onDelete('cascade');
            $table->string('description');
            $table->integer('qty_hrs');
            $table->decimal('rate', 10, 2);
            $table->decimal('total', 15, 2);
            $table->decimal('cost', 10, 2);
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
        Schema::dropIfExists('job_invoices');
    }
};

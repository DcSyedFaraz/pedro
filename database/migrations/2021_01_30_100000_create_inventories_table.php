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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('vendor')->nullable();
            $table->date('date')->nullable();
            $table->string('paid_for')->nullable();
            $table->integer('paid')->default(0);
            $table->string('receive')->nullable();
            $table->string('product')->nullable();
            $table->integer('quantity')->default(0);
            $table->integer('unreceived')->default(0);
            $table->integer('unit_cost')->default(0);
            $table->integer('total')->default(0);
            $table->string('subtotal')->nullable();
            $table->string('discount')->nullable();
            $table->string('tax_paid')->nullable();
            $table->string('ship_cost')->nullable();
            $table->string('grand_total')->nullable();
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
        Schema::dropIfExists('inventories');
    }
};

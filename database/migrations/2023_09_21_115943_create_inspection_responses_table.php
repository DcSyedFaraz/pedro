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
        Schema::create('inspection_responses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('location_id');
            $table->unsignedBigInteger('checklist_item_id');
            $table->string('rating'); // Green, Yellow, Red
            $table->text('remarks')->nullable();
            // Add other response-related fields here
            $table->timestamps();

            $table->foreign('location_id')->references('id')->on('locations');
            $table->foreign('checklist_item_id')->references('id')->on('checklist_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspection_responses_table');
    }
};

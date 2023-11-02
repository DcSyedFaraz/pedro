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
        Schema::create('problem_reportings', function (Blueprint $table) {
            $table->id();
            $table->string('job');
            $table->string('location');
            $table->string('location_supervisor');
            $table->date('problem_date');
            $table->string('type_of_problem');
            $table->text('description_of_problem');
            $table->string('investigator_of_problem');
            $table->text('result_of_investigation');
            $table->text('suggestions');
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
        Schema::dropIfExists('problem_reportings');
    }
};

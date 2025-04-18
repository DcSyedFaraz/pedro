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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('estimate_id')->nullable();
            $table->integer('account_manager_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('location_unit')->nullable();
            $table->string('location_name')->nullable();
            $table->string('location_gated_property')->nullable();
            $table->string('location_address')->nullable();
            $table->string('location_city')->nullable();
            $table->string('location_state')->nullable();
            $table->string('location_zipcode')->nullable();
            $table->integer('job_cat_id')->nullable();
            $table->string('job_sub_cat_id')->nullable();
            $table->longText('job_description')->nullable();
            $table->longText('job_sub_description')->nullable();
            $table->string('po_no')->nullable();
            $table->string('job_source')->nullable();
            $table->string('agent')->nullable();
            //Primary Contact
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('phone')->nullable();
            $table->integer('ext_id')->nullable();
            $table->string('ext')->nullable();
            $table->string('email')->nullable();
            //    custom filed
            $table->string('customer_homeowner')->nullable();
            $table->string('customer_unit_cordination')->nullable();
            //job information
            $table->string('current_status')->nullable();
            $table->string('start_date')->nullable();
            $table->string('start_duration')->nullable();
            $table->string('end_duration')->nullable();
            $table->string('end_date')->nullable();
            $table->string('multe_job')->nullable();
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->string('time_duration')->nullable();
            $table->string('job_priority')->nullable();
            $table->string('assigned_tech')->nullable();
            // $table->string('assigned_tech')->nullable();
            $table->string('notify_tech_assign')->nullable();
            $table->text('notes_for_tech')->nullable();
            $table->string('scheduled_at')->nullable();
            $table->text('completion_notes')->nullable();
            $table->string('image')->nullable();
            $table->string('document')->nullable();
            $table->string('billable')->nullable();
            $table->text('mark_description')->nullable();
            $table->string('note_to_cust')->nullable();
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
        Schema::dropIfExists('jobs');
    }
};

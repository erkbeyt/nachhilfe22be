<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutoringDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutoring_dates', function (Blueprint $table) {
            $table->id();
            $table->dateTime('tutoringdate');
            $table->boolean('booked');
            $table->boolean('accepted');
            $table->string('status')->nullable();
            // fk fields for relations - model name lowercase + "_id"
            $table->bigInteger('tutoring_id')->unsigned();
            // create constraint in DB
            $table->foreign('tutoring_id')
                ->references('id')->on('tutorings')
                ->onDelete('cascade');
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
        Schema::dropIfExists('tutoringdates');
    }
}

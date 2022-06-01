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
            $table->integer('user_id')->nullable();
            $table->foreignId('tutoring_id')->constrained()->onDelete('cascade');
            $table->timestamps();

//            // fk fields for relations - model name lowercase + "_id"
//            $table->bigInteger('tutoring_id')->unsigned();
//            // create constraint in DB
//            $table->foreign('tutoring_id')
//                ->references('id')->on('tutorings')
//                ->onDelete('cascade');
//            //Helper to know who commented on this tutoring offer
//            $table->bigInteger('user_id')->unsigned();
//            // create constraint in DB
//            $table->foreign('user_id')
//                ->references('id')->on('users')
//                ->onDelete('cascade');

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

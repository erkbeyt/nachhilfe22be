<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutoringUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tutoring_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('tutoring_id')->constrained()->onDelete('cascade');
            $table->timestamps();
            $table->primary(['user_id','tutoring_id']);

//            $table->bigInteger('user_id')->unsigned();
//            // create constraint in DB
//            $table->foreign('user_id')
//                ->references('id')->on('users')
//                ->onDelete('cascade');
//
//            $table->bigInteger('tutoring_id')->unsigned();
//            // create constraint in DB
//            $table->foreign('tutoring_id')
//                ->references('id')->on('tutorings')
//                ->onDelete('cascade');
//            $table->timestamps();
//            $table->primary(['user_id','tutoring_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tutoring_user');
    }
}

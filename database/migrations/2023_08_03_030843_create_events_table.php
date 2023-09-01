<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('space_id');
            $table->string('title');
            $table->text('summary')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->time('start_time');
            $table->time('end_time')->nullable();
            $table->string('cover_image')->nullable();
            $table->integer('number_of_attendees')->nullable();
            $table->boolean('registration_required')->default(false);
            $table->string('registration_url')->nullable();
            $table->string('status')->default('solicitado');
            $table->boolean('published')->default(false);

            // Restricciones de llaves foráneas
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('space_id')->references('id')->on('spaces')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
}

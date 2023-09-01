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
            $table->unsignedBigInteger('register_id')->nullable();
            $table->unsignedBigInteger('responsible_id');
            $table->unsignedBigInteger('coresponsible_id')->nullable();
            $table->unsignedBigInteger('department_id')->nullable();
            $table->unsignedBigInteger('event_type_id')->nullable();
            $table->string('title');
            $table->text('summary')->nullable();
            $table->string('program')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->time('start_time');
            $table->time('end_time')->nullable();
            $table->string('cover_image')->nullable();
            $table->integer('number_of_attendees')->nullable();
            $table->boolean('registration_required')->default(false);
            $table->string('registration_url')->nullable();
            $table->boolean('space_required')->default(false);
            $table->boolean('recording_required')->default(false);
            $table->boolean('transmission_required')->default(false);
            $table->string('status')->default('borrador');
            $table->boolean('published')->default(false);
            $table->boolean('cancelled')->default(false);

            // Restricciones de llaves foráneas
            $table->foreign('responsible_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('coresponsible_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('register_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('event_type_id')->references('id')->on('event_types');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('events');
    }
}

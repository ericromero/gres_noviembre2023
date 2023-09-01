<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventParticipantsTable extends Migration
{
    public function up()
    {
        Schema::create('event_participants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('fullname')->nullable();
            $table->unsignedBigInteger('participation_type_id');
            $table->timestamps();
            
            // Restricciones de clave foránea
            $table->unique(['event_id', 'fullname', 'participation_type_id'], 'unique_participant');
            $table->foreign('event_id')->references('id')->on('events');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('participation_type_id')->references('id')->on('participation_types');
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_participants');
    }
}

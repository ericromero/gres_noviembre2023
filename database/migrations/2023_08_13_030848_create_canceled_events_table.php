<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCanceledEventsTable extends Migration
{
    public function up()
    {
        Schema::create('canceled_events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->text('cancellation_reason');
            $table->unsignedBigInteger('canceled_by_user_id');

            // Restricciones de llaves foráneas
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('canceled_by_user_id')->references('id')->on('users');

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('canceled_events');
    }
}

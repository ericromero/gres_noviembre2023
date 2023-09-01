<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventSpacesTable extends Migration
{
    public function up()
    {
        Schema::create('event_spaces', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->unsignedBigInteger('space_id');
            $table->enum('status', ['solicitado', 'aceptado', 'rechazado'])->default('solicitado');
            $table->unsignedBigInteger('validate_by')->nullable();
            $table->text('observation')->nullable();
            $table->timestamps();
            
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('space_id')->references('id')->on('spaces')->onDelete('cascade');
            $table->foreign('validate_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_spaces');
    }
}

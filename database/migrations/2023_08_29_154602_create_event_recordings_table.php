<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventRecordingsTable extends Migration
{
    public function up()
    {
        Schema::create('event_recordings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('event_id');
            $table->enum('status', ['solicitado', 'aceptado', 'rechazado'])->default('solicitado');
            $table->unsignedBigInteger('validate_by')->nullable();
            $table->text('observation')->nullable();
            $table->timestamps();
            
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
            $table->foreign('validate_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('event_recordings');
    }
}

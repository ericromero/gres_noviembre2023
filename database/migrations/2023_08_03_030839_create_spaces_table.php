<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpacesTable extends Migration
{
    public function up()
    {
        Schema::create('spaces', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('department_id');
            $table->string('name');
            $table->string('location')->nullable();
            $table->integer('capacity')->nullable();
            $table->boolean('availability')->default(true);
            $table->string('photography')->nullable();

            // Restricciones de llaves foráneas
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');

            // Restricciones de unicidad
            $table->unique(['department_id', 'name']);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('spaces');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentsTable extends Migration
{
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->unsignedBigInteger('responsible_id')->unique()->nullable();
            $table->unsignedBigInteger('institution_id');

            // Restricciones de llaves foráneas
            $table->foreign('responsible_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('institution_id')->references('id')->on('institutions')->onDelete('cascade');

            // Restricción de unicidad para los campos "name" e "institution_id"
            $table->unique(['name', 'institution_id']);

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('departments');
    }
}

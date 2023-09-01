<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('institutions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            // Agrega aquí los campos adicionales según tus necesidades.
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('institutions');
    }
};

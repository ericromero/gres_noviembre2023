<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('adscriptions', function (Blueprint $table) {
            // Agregar el campo 'external' después de 'department_id'
            $table->boolean('external')->default(false)->after('department_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('adscriptions', function (Blueprint $table) {
            // Revertir la migración eliminando el campo 'external'
            $table->dropColumn('external');
        });
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedBigInteger('audience_id')->after('end_date');
            $table->foreign('audience_id')->references('id')->on('audiences');
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['audience_id']);
            $table->dropColumn('audience_id');
        });
    }
};

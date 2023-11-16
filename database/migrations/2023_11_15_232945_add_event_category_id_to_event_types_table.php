<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('event_types', function (Blueprint $table) {
            $table->unsignedBigInteger('event_category_id')->after('name');
            $table->foreign('event_category_id')->references('id')->on('event_categories');
        });
    }

    public function down()
    {
        Schema::table('event_types', function (Blueprint $table) {
            $table->dropForeign(['event_category_id']);
            $table->dropColumn('event_category_id');
        });
    }
};

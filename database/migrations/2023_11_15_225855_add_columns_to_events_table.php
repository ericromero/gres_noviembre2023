<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedBigInteger('knowledge_area_id')->after('end_date');
            $table->string('gender_equality')->after('end_date');
            $table->string('project_type')->after('end_date');
            $table->string('scope')->after('end_date');
            $table->string('modality')->after('end_date');

            $table->foreign('knowledge_area_id')
                ->references('id')
                ->on('knowledge_areas')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['knowledge_area_id']);
            $table->dropColumn('knowledge_area_id');
            $table->dropColumn('project_type');
            $table->dropColumn('scope');
            $table->dropColumn('modality');
            $table->dropColumn('gender_equality');
        });
    }
};

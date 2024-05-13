<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('landing_pages', function (Blueprint $table) {
            // Zorg ervoor dat je 'unsignedBigInteger' gebruikt voor de 'color_id' kolom
            $table->unsignedBigInteger('color_id')->nullable()->after('image');
            $table->foreign('color_id')->references('id')->on('colors')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::table('landing_pages', function (Blueprint $table) {
            $table->dropForeign(['color_id']);
            $table->dropColumn('color_id');
        });
    }
};

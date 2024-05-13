<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add is_winner column to bids table
        Schema::table('bids', function (Blueprint $table) {
            $table->boolean('is_winner')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop is_winner column from bids table
        Schema::table('bids', function (Blueprint $table) {
            $table->dropColumn('is_winner');
        });
    }
};

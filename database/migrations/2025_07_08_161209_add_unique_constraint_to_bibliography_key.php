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
        Schema::table('bibliographies', function (Blueprint $table) {
            $table->unique('key','unique_bibliography_key');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bibliographies', function (Blueprint $table) {
            $table->dropUnique(['key']);
        });
    }
};

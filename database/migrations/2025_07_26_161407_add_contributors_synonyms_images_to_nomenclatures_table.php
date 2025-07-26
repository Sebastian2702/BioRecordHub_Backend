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
        Schema::table('nomenclatures', function (Blueprint $table) {
            $table->string('contributors')->nullable()->after('remarks');
            $table->text('synonyms')->nullable()->after('contributors');
            $table->json('images')->nullable()->after('synonyms');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('nomenclatures', function (Blueprint $table) {
            $table->dropColumn(['contributors', 'synonyms', 'images']);
        });
    }
};

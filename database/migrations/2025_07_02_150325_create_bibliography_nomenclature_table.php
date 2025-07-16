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
        Schema::create('bibliography_nomenclature', function (Blueprint $table) {
            $table->foreignId('bibliography_id')->constrained()->onDelete('cascade');
            $table->foreignId('nomenclature_id')->constrained()->onDelete('cascade');
            $table->primary(['bibliography_id', 'nomenclature_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bibliography_nomenclature');
    }
};

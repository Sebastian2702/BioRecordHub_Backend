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
        Schema::create('occurrences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nomenclature_id')->constrained()->onDelete('cascade');
            $table->foreignId('project_id')->constrained()->onDelete('cascade');

            $table->string('scientific_name');
            $table->string('event_date');
            $table->string('country')->nullable();
            $table->string('locality')->nullable();
            $table->decimal('decimal_latitude', 10, 8)->nullable();
            $table->decimal('decimal_longitude', 11, 8)->nullable();
            $table->string('basis_of_record')->nullable();
            $table->string('occurrence_id')->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('occurrences');
    }
};

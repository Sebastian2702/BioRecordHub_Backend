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
        Schema::create('nomenclatures', function (Blueprint $table) {
            $table->id();
            $table->string('kingdom');
            $table->string('phylum');
            $table->string('subphylum');
            $table->string('class');
            $table->string('order');
            $table->string('suborder');
            $table->string('infraorder');
            $table->string('superfamily');
            $table->string('family');
            $table->string('subfamily')->nullable();
            $table->string('tribe')->nullable();
            $table->string('genus')->nullable();
            $table->string('subgenus')->nullable();
            $table->string('species');
            $table->string('subspecies')->nullable();
            $table->string('author');
            $table->text('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nomenclatures');
    }
};

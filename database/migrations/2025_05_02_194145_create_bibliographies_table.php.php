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
        Schema::create('bibliographies', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->string('item_type');
            $table->year('publication_year');
            $table->text('author');
            $table->text('title');
            $table->text('publication_title');
            $table->string('isbn')->nullable();
            $table->string('issn')->nullable();
            $table->string('doi')->nullable();
            $table->text('url')->nullable();
            $table->longText('abstract_note')->nullable();
            $table->date('date');
            $table->timestamp('date_added');
            $table->timestamp('date_modified')->nullable();
            $table->date('access_date')->nullable();
            $table->string('pages')->nullable();
            $table->integer('num_pages')->nullable();
            $table->string('issue')->nullable();
            $table->string('volume')->nullable();
            $table->string('number_of_volumes')->nullable();
            $table->string('journal_abbreviation')->nullable();
            $table->string('short_title')->nullable();
            $table->string('series')->nullable();
            $table->string('series_number')->nullable();
            $table->string('series_text')->nullable();
            $table->string('series_title')->nullable();
            $table->string('publisher')->nullable();
            $table->string('place')->nullable();
            $table->string('language')->nullable();
            $table->string('rights')->nullable();
            $table->string('type')->nullable();
            $table->string('archive')->nullable();
            $table->string('archive_location')->nullable();
            $table->string('library_catalog')->nullable();
            $table->string('call_number')->nullable();
            $table->text('extra')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bibliographies');
    }
};

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
        Schema::table('occurrences', function (Blueprint $table) {
            $table->string('institution_code')->after('contributors');
            $table->string('collection_code')->after('institution_code');
            $table->string('catalog_number')->after('collection_code');
            $table->string('recorded_by')->after('catalog_number');
            $table->string('identified_by')->after('recorded_by');
            $table->string('date_identified')->after('identified_by');
            $table->text('occurrence_remarks')->after('date_identified');
            $table->string('language')->after('occurrence_remarks');
            $table->string('license')->after('language');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('occurrences', function (Blueprint $table) {
            $table->dropColumn('institution_code');
            $table->dropColumn('collection_code');
            $table->dropColumn('catalog_number');
            $table->dropColumn('recorded_by');
            $table->dropColumn('identified_by');
            $table->dropColumn('date_identified');
            $table->dropColumn('occurrence_remarks');
            $table->dropColumn('language');
            $table->dropColumn('license');
        });
    }
};

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
        // Add the file_path column to the reports table
        Schema::table('reports', function (Blueprint $table) {
            $table->string('file_path')->nullable(); // Column to store the file path
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove the file_path column from the reports table
        Schema::table('reports', function (Blueprint $table) {
            $table->dropColumn('file_path');
        });
    }
};


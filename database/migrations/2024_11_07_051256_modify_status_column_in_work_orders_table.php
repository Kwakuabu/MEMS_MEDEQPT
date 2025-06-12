<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('work_orders', function (Blueprint $table) {
            $table->enum('status', ['pending', 'in_progress', 'completed', 'approved'])->default('pending')->change();
        });
    }
    
    public function down()
    {
        Schema::table('work_orders', function (Blueprint $table) {
            $table->enum('status', ['pending', 'in_progress', 'completed'])->default('pending')->change();
        });
    }
    
};

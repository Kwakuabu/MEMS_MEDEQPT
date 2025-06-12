<?php

// database/migrations/xxxx_xx_xx_create_work_orders_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('work_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fault_report_id')->constrained()->onDelete('cascade');  // Link to Fault Report
            $table->foreignId('equipment_id')->constrained()->onDelete('cascade');  // Link to Equipment
            $table->date('repair_date')->nullable();  // Date of repair
            $table->string('repair_location')->nullable();  // Repair location (e.g., workshop or on-the-spot)
            $table->text('parts_required')->nullable();  // Parts required for the repair
            $table->text('repair_description')->nullable();  // Repair description
            $table->enum('status', ['pending', 'in_progress', 'completed', 'approved'])->default('pending');
            // Status of the work order
            $table->foreignId('bmet_id')->nullable()->constrained('users')->onDelete('set null');  // Assigned BMET
            $table->foreignId('engineer_id')->nullable()->constrained('users')->onDelete('set null');  // Assigned Engineer
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('work_orders');
    }
}

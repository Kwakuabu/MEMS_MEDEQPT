<?php

// database/migrations/xxxx_xx_xx_create_fault_reports_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaultReportsTable extends Migration
{
    public function up()
    {
        Schema::create('fault_reports', function (Blueprint $table) {
            $table->id();
            $table->string('job_number')->unique();  // Unique job number
            $table->foreignId('equipment_id')->constrained()->onDelete('cascade');  // Linked to equipment table
            $table->foreignId('reported_by')->constrained('users')->onDelete('cascade');  // User who reported
            $table->foreignId('received_by')->nullable()->constrained('users')->onDelete('set null');  // Received by engineer
            $table->foreignId('department_id')->constrained()->onDelete('cascade');  // Department
            $table->date('report_date')->nullable();  // Date of report
            $table->text('fault_description');  // Description of the fault
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('fault_reports');
    }
}


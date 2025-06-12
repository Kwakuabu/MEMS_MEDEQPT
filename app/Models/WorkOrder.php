<?php

// app/Models/WorkOrder.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'fault_report_id',
        'repair_date',
        'equipment_id', 
        'repair_location',
        'parts_required',
        'repair_description',
        'status',
        'bmet_id',
        'engineer_id'
    ];

    public function faultReport()
    {
        return $this->belongsTo(FaultReport::class);
    }
    
    public function bmet()
    {
        return $this->belongsTo(User::class, 'bmet_id');
    }
    
    public function engineer()
    {
        return $this->belongsTo(User::class, 'engineer_id');
    }

    // In WorkOrder.php model

    public function equipment()
    {
        return $this->belongsTo(Equipment::class, 'equipment_id'); // Make sure the foreign key matches the column name
    }

    
}

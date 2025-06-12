<?php

// app/Models/FaultReport.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FaultReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_number',
        'equipment_id',
        'reported_by',
        'received_by',
        'department_id',
        'report_date',
        'fault_description',
    ];

    public function workOrder()
    {
        return $this->hasOne(WorkOrder::class);
    }
    
    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }
    
    public function reporter()
    {
        return $this->belongsTo(User::class, 'reported_by');
    }
    
    public function receiver()
    {
        return $this->belongsTo(User::class, 'received_by');
    }

    
}

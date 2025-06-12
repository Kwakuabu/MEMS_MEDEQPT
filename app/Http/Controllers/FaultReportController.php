<?php

// app/Http/Controllers/FaultReportController.php

namespace App\Http\Controllers;

use App\Models\FaultReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FaultReportController extends Controller
{
    public function create()
    {
        return view('fault_reports.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'equipment_id' => 'required|exists:equipment,id',
            'fault_description' => 'required|string',
        ]);

        FaultReport::create([
            'job_number' => 'JOB-' . uniqid(),
            'equipment_id' => $validated['equipment_id'],
            'reported_by' => Auth::id(),
            'department_id' => Auth::user()->department_id,
            'report_date' => now(),
            'engineer_id' => Auth::id(), // Set the engineer ID here
            'fault_description' => $validated['fault_description'],
        ]);

        return redirect()->route('engineer.dashboard')->with('success', 'Fault report submitted successfully.');
    }
}

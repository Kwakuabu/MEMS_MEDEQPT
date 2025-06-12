<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Equipment; 
use App\Models\Fault;
use App\Models\WorkOrder;
use App\Models\FaultReport; // Import the Equipment model

class ClinicianDashboardController extends Controller
{
    public function index()
    {
        $departmentId = Auth::user()->department_id;

        // Fetch team members belonging to the same department
        $members = User::where('department_id', $departmentId)->get();

        // Fetch equipment belonging to the same department
        $equipment = Equipment::where('department_id', $departmentId)->get();

        // Pass the members and equipment to the view
        return view('clinician.dashboard', compact('members', 'equipment'));
    }

     // Define the inventory method
     public function inventory()
     {
         $departmentId = Auth::user()->department_id;
 
         // Fetch equipment belonging to the clinician's department
         $equipment = Equipment::where('department_id', $departmentId)->get();
 
         return view('clinician.inventory', compact('equipment'));
     }
 
     public function reportFault()
     {
         $departmentId = Auth::user()->department_id;
     
         // Fetch the equipment associated with the clinician's department
         $equipment = Equipment::where('department_id', $departmentId)->get();
     
         // Pass the equipment variable to the view
         return view('clinician.faultreporting', compact('equipment'));
     }
     

     public function store(Request $request)
     {
         // Validate the incoming request
         $validated = $request->validate([
             'equipment_id' => 'required|exists:equipment,id',
             'fault_description' => 'required|string',
         ]);
     
         // Create the FaultReport instance and store it in a variable
         $faultReport = FaultReport::create([
             'job_number' => 'JOB-' . uniqid(),
             'equipment_id' => $validated['equipment_id'],
             'reported_by' => Auth::id(),
             'department_id' => Auth::user()->department_id,
             'report_date' => now(),
             'fault_description' => $validated['fault_description'],
         ]);
     
         // Now use the $faultReport variable to create the WorkOrder
         WorkOrder::create([
             'fault_report_id' => $faultReport->id,
             'repair_location' => 'on-site', // Default or based on your logic
             'status' => 'pending', // Default status
             // Optionally add other fields like parts_required or repair_description here
         ]);
     
         // Redirect with a success message
         return redirect()->route('clinician.faulthistory')->with('success', 'Fault report submitted successfully.');
     }
     

    public function faulthistory()
    {
        // Retrieve faults reported by the authenticated user
    $faults = FaultReport::with('equipment')
    ->where('reported_by', Auth::id()) // Use 'reported_by' instead of 'user_id'
    ->get();

    return view('clinician.faulthistory', compact('faults'));
    }

    // Additional methods for reporting equipment faults can be added here
}

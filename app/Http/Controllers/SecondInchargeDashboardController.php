<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WorkOrder; // Example: Importing a WorkOrder model
use App\Models\Report; // Example: Importing a Report model
use App\Models\Department; // Example: Importing a Department model

class SecondInchargeDashboardController extends Controller
{
    /**
     * Display the dashboard for the second in-charge.
     */
    public function index()
    {
        // Retrieve dashboard data (e.g., summary of reports or work orders)
        $workOrders = WorkOrder::where('status', 'pending')->get(); // Example query
        $reports = Report::latest()->take(5)->get(); // Example query to get recent reports
        
        return view('second_incharge.dashboard', compact('workOrders', 'reports'));
    }

    /**
     * View and review reports submitted by engineers or technicians.
     */
    public function viewReports()
    {
        // Retrieve all reports to display
        $reports = Report::all();
        
        return view('second_incharge.reports', compact('reports'));
    }

    /**
     * Review and approve or deny work orders.
     */
    public function reviewWorkOrders()
    {
        // Retrieve work orders that need review
        $workOrders = WorkOrder::where('status', 'pending')->get();
        
        return view('second_incharge.review_work_orders', compact('workOrders'));
    }

    /**
     * Update the status of a work order (approve or deny).
     */
    public function updateWorkOrderStatus(Request $request, $workOrderId)
    {
        $workOrder = WorkOrder::findOrFail($workOrderId);
        $workOrder->status = $request->input('status'); // 'approved' or 'denied'
        $workOrder->save();
        
        return redirect()->route('second_incharge.review-work-orders')->with('success', 'Work order status updated successfully.');
    }

    /**
     * Manage department assignments.
     */
    public function manageDepartments()
    {
        // Retrieve all departments for management
        $departments = Department::all();
        
        return view('second_incharge.manage_departments', compact('departments'));
    }

    /**
     * Assign a department to a specific user (e.g., an engineer or technician).
     */
    public function assignDepartment(Request $request)
    {
        $validatedData = $request->validate([
            'user_id' => 'required|exists:users,id',
            'department_id' => 'required|exists:departments,id',
        ]);

        // Logic to assign the department to the user
        $user = User::find($validatedData['user_id']);
        $user->department_id = $validatedData['department_id'];
        $user->save();

        return redirect()->route('second_incharge.departments')->with('success', 'Department assigned successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\User;
use App\Models\WorkOrder;
use App\Models\Report;

class InChargeDashboardController extends Controller
{
    public function index()
    {
        // Logic to get departmental information and personnel assignments
        $departments = Department::with('users')->get(); // Fetch all departments with their assigned users
        return view('sec_incharge.dashboard', compact('departments'));
    }

    /**
     * Show details of a specific department.
     */
    public function showDepartment($id)
    {
        $department = Department::with('users')->findOrFail($id); // Fetch department with related users
        return view('incharge.departments', compact('department'));
    }

    /**
     * Assign a user to a department.
     */
    public function assignUserToDepartment(Request $request, $departmentId)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $user = User::findOrFail($request->user_id);
        $user->department_id = $departmentId;
        $user->save();

        return redirect()->back()->with('success', 'User assigned to department successfully.');
    }

    /**
     * View reports related to a specific department.
     */
    public function viewReportsByDepartment($id)
    {
        $reports = Report::where('department_id', $id)->get(); // Get reports for a specific department
        return view('incharge.reports', compact('reports'));
    }

    /**
     * View and manage work orders.
     */
    public function manageWorkOrders($id = null)
    {
        $workOrders = $id 
            ? WorkOrder::where('department_id', $id)->get() // Get work orders by department if $id is provided
            : WorkOrder::all(); // Otherwise, get all work orders

        return view('incharge.work_orders', compact('workOrders'));
    }

    /**
     * Approve or deny a work order.
     */
    public function updateWorkOrderStatus(Request $request, $workOrderId)
    {
        $request->validate([
            'status' => 'required|in:approved,denied',
        ]);

        $workOrder = WorkOrder::findOrFail($workOrderId);
        $workOrder->status = $request->status;
        $workOrder->save();

        return redirect()->back()->with('success', 'Work order status updated successfully.');
    }

    /**
     * View user rotation history in departments.
     */
    public function viewUserRotationHistory($userId)
    {
        $user = User::with('rotationHistory')->findOrFail($userId); // Assuming a relationship `rotationHistory` exists
        return view('incharge.user_rotation_history', compact('user'));
    }

    /**
     * Manage department assignments for rotation.
     */
    public function rotateDepartmentAssignments(Request $request)
    {
        // Logic to rotate or reassign department members based on criteria
        // Example: Rotate users to the next department
        $departments = Department::all();
        foreach ($departments as $department) {
            // Custom logic for rotation
        }

        return redirect()->back()->with('success', 'Department rotation updated successfully.');
    }
}

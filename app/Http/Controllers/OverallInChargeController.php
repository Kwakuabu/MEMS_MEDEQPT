<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\User;
use App\Models\Report;
use App\Models\WorkOrder;
use Illuminate\Http\Request;

class OverallInChargeController extends Controller
{
    // Dashboard - Display departments and users
    public function index()
    {
        $users = User::with('role')->get();

        // Pass users to the view
        return view('incharge.dashboard', compact('users'));
    }

    // Show department details with assigned users
    public function showDepartment($id)
    {
        $department = Department::with('users')->findOrFail($id); // Get department by ID
        return view('incharge.departments', compact('department'));
    }

    // Assign user to a department
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

    // View reports for a specific department
    public function viewReportsByDepartment($id)
    {
        $reports = Report::where('department_id', $id)->get();
        return view('incharge.reports', compact('reports'));
    }

    // Manage work orders, filtered by department if needed
    public function manageWorkOrders($id = null)
    {
        $workOrders = $id
            ? WorkOrder::where('department_id', $id)->get()
            : WorkOrder::all();

        return view('incharge.work_orders', compact('workOrders'));
    }

    // Update work order status (approved or denied)
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

    // View user's rotation history
    public function viewUserRotationHistory($userId)
    {
        $user = User::with('rotationHistory')->findOrFail($userId);
        return view('incharge.user_rotation_history', compact('user'));
    }

    // Rotate department assignments for all users
    public function rotateDepartmentAssignments(Request $request)
    {
        $departments = Department::all();

        foreach ($departments as $index => $department) {
            $nextDepartment = $departments[($index + 1) % count($departments)];

            foreach ($department->users as $user) {
                $user->department_id = $nextDepartment->id;
                $user->save();
            }
        }

        return redirect()->back()->with('success', 'Department rotation updated successfully.');
    }

    // Manage users and their departments
    public function manageUsers()
    {
        $users = User::all(); // Fetch all users with their departments
        return view('incharge.manage_users', compact('users'));
    }

    // Manage all departments
    public function manageDepartments()
    {
        $departments = Department::all(); // Get all departments
        return view('incharge.assign_departments', compact('departments'));
    }

    // Update the department of a specific user
    public function updateDepartment(Request $request, $userId)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
        ]);
        $departments = Department::all();
        $user = User::findOrFail($userId);
        $user->department_id = $request->department_id;
        $user->save();

        return redirect()->route('incharge.manage-users')->with('success', 'User department updated successfully.');
    }

    public function manageRotations()
    {
        // Get all departments and the users (members) of each department for rotation management
        $departments = Department::with('users')->get();

        // Pass the data to the view
        return view('incharge.manage-rotations', compact('departments'));
    }

    public function updateRotation(Request $request, Department $department)
{
    // Validate the request
    $validated = $request->validate([
        'user_id' => 'required|exists:users,id',
        'new_department_id' => 'required|exists:departments,id',
    ]);

    // Update the department for the selected user
    $user = User::findOrFail($validated['user_id']);
    $user->department_id = $validated['new_department_id'];
    $user->save();

    return redirect()->route('incharge.manage-rotations')->with('success', 'Rotation updated successfully!');
}

public function showApprovedWorkOrders()
{
    $workOrders = WorkOrder::where('status', 'approved')->with('report', 'engineer')->get();
    return view('incharge.manage-rotations', compact('workOrders'));
}



}

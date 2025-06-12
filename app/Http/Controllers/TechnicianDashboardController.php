<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TechnicianDashboardController extends Controller
{
    public function index()
    {
        $departmentId = Auth::user()->department_id;

        // Fetch team members belonging to the same department
        $members = User::where('department_id', $departmentId)->get();

        // Pass the members to the view
        return view('technician.dashboard', compact('members'));
    }

    // Additional methods for logging activities can be added here
}

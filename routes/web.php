<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ClinicianDashboardController;
use App\Http\Controllers\TechnicianDashboardController;
use App\Http\Controllers\EngineerDashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\FaultController; // New controller for Faults
use App\Http\Controllers\WorkOrderController; // New controller for Work Orders
use App\Http\Controllers\SecondInchargeDashboardController;
use App\Http\Controllers\OverallInChargeController;
use Illuminate\Support\Facades\Route;

// Authentication Routes
Route::get('/register', [RegisteredUserController::class, 'create'])->name('register');
Route::post('/register', [RegisteredUserController::class, 'store']);
Route::get('/login', [RegisteredUserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [RegisteredUserController::class, 'login'])->name('login.submit');

// User Dashboard Routes
Route::middleware(['auth'])->group(function () {
    // Redirect based on role after login or registration
    Route::get('/home', function () {
        if (auth()->user()->role_id == 1) { // Assuming 1 is the role ID for Clinician
            return redirect()->route('clinician.dashboard');
        } elseif (auth()->user()->role_id == 2) { // Assuming 2 is the role ID for Technician
            return redirect()->route('technician.dashboard');
        } elseif (auth()->user()->role_id == 3) { // Assuming 3 is the role ID for Engineer
            return redirect()->route('engineer.dashboard');
        } elseif (auth()->user()->role_id == 5) { // Assuming 4 is the role ID for Overall In-charge
            return redirect()->route('incharge.dashboard');
        } elseif (auth()->user()->role_id == 4) { // Assuming 5 is the role ID for Second In-charge
            return redirect()->route('second_incharge.dashboard');}

        // Redirect to a default route if no role matches
        return redirect('/'); // Change this to your desired default route
    })->name('home');
     
   // Overall In-charge Dashboard
   Route::get('/incharge/dashboard', [OverallInChargeController::class, 'index'])->name('incharge.dashboard');
   Route::get('/incharge/manage-rotations', [OverallInChargeController::class, 'manageRotations'])->name('incharge.manage-rotations');
   Route::get('/incharge/view-reports', [OverallInChargeController::class, 'viewReports'])->name('incharge.view_reports');
   Route::post('/incharge/assign-department', [OverallInChargeController::class, 'assignDepartment'])->name('incharge.assign_department');
   Route::get('incharge/manage-users', [OverallInChargeController::class, 'manageUsers'])->name('incharge.manage-users');
   Route::post('incharge/update-department/{userId}', [OverallInChargeController::class, 'updateDepartment'])->name('incharge.update-department');
   Route::post('update-rotation/{department}', [OverallInChargeController::class, 'updateRotation'])->name('incharge.update-rotation');
   Route::get('/incharge/departments', [OverallInChargeController::class, 'manageDepartments'])->name('incharge.departments');
   


 
    // Second In-charge Dashboard
    Route::get('/second_incharge/dashboard', [SecondInchargeDashboardController::class, 'index'])->name('second_incharge.dashboard');
    Route::get('/second_incharge/monitor', [SecondInchargeDashboardController::class, 'monitorEquipment'])->name('second_incharge.monitor');
    Route::post('/second_incharge/approve-report', [SecondInchargeDashboardController::class, 'approveReport'])->name('second_incharge.approve_report');
    Route::post('/second_incharge/reject-report', [SecondInchargeDashboardController::class, 'rejectReport'])->name('second_incharge.reject_report');
    
     // Clinician Dashboard
    Route::get('/clinician/dashboard', [ClinicianDashboardController::class, 'index'])->name('clinician.dashboard');
    Route::get('/clinician/inventory', [ClinicianDashboardController::class, 'inventory'])->name('clinician.inventory');
    Route::get('/clinician/faultreporting', [ClinicianDashboardController::class, 'reportFault'])->name('clinician.faultreporting');
    Route::get('/clinician/faulthistory', [ClinicianDashboardController::class, 'faultHistory'])->name('clinician.faulthistory');
    Route::post('/clinician/faultreporting', [ClinicianDashboardController::class, 'store'])->name('clinician.faultreporting.store');
    
    // Technician Dashboard
    Route::get('/technician/dashboard', [TechnicianDashboardController::class, 'index'])->name('technician.dashboard');
    Route::get('/technician/workorders', [TechnicianDashboardController::class, 'workOrders'])->name('technician.workorders');
    Route::get('/technician/activitylogs', [TechnicianDashboardController::class, 'activityLogs'])->name('technician.activitylogs');
    
    
    // Engineer Dashboard
    Route::get('/engineer/dashboard', [EngineerDashboardController::class, 'index'])->name('engineer.dashboard');
    Route::get('/engineer/inventory', [EngineerDashboardController::class, 'inventory'])->name('engineer.inventory');
    Route::get('/engineer/work-orders', [EngineerDashboardController::class, 'workOrders'])->name('engineer.work_orders');
    Route::post('/engineer/work_orders/{workOrderId}/update', [EngineerDashboardController::class, 'updateWorkOrderStatus'])->name('engineer.work_orders.update_status');
    Route::get('/engineer/reports', [EngineerDashboardController::class, 'reports'])->name('engineer.reports');
    Route::post('/engineer/add-equipment', [EngineerDashboardController::class, 'addEquipment'])->name('engineer.add_equipment');
    Route::post('/engineer/work_orders/{id}/approve', [EngineerDashboardController::class, 'approveWorkOrder'])->name('engineer.work_orders.approve');
    Route::post('/engineer/work_orders/{id}/deny', [EngineerDashboardController::class, 'denyWorkOrder'])->name('engineer.work_orders.deny');
    Route::post('/engineer/workorder/store', [EngineerDashboardController::class, 'storeWorkOrder'])
        ->name('engineer.workorder.store'); 
    Route::delete('/equipment/{id}', [EngineerDashboardController::class, 'deleteEquipment'])->name('engineer.delete_equipment');
    Route::post('/engineer/weeklyreport/store', [EngineerDashboardController::class, 'storeWeeklyReport'])
        ->name('engineer.weeklyreport.store');

    
    // General User Routes
    Route::resource('users', UsersController::class);
    Route::resource('equipment', EquipmentController::class);
    Route::resource('reports', ReportController::class);
});

// Fallback Route
Route::get('/', function () {
    return view('welcome'); // Adjust to your desired landing page
});

// Logout Route
Route::post('/logout', [RegisteredUserController::class, 'logout'])->name('logout')->middleware('auth');

// Include auth routes
require __DIR__.'/auth.php';

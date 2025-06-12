<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Equipment;
use App\Models\Fault;
use App\Models\WorkOrder;
use App\Models\WeeklyReport; // Ensure WeeklyReport model is imported

class EngineerDashboardController extends Controller
{
    public function index()
    {
        // Fetch the currently authenticated user's department
        $departmentId = Auth::user()->department_id;

        // Fetch team members belonging to the same department
        $members = User::where('department_id', $departmentId)->get();

        // Pass the members to the view
        return view('engineer.dashboard', compact('members'));
    }

    public function inventory()
    {
        $departmentId = Auth::user()->department_id;

        // Fetch equipment belonging to the same department
        $equipment = Equipment::where('department_id', $departmentId)->get();

        // Pass the equipment to the view
        return view('engineer.inventory', compact('equipment'));
    }

    public function addEquipment(Request $request)
    {
        $validatedData = $request->validate([
            'machine_description' => 'required|string|max:255',
            'quantity' => 'required|integer|min:1',
            'brand_name' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'serial_number' => 'required|string|max:255|unique:equipment,serial_number', // Ensure uniqueness
        ]);

        $equipment = new Equipment();
        $equipment->machine_description = $validatedData['machine_description'];
        $equipment->quantity = $validatedData['quantity'];
        $equipment->brand_name = $validatedData['brand_name'];
        $equipment->model = $validatedData['model'];
        $equipment->serial_number = $validatedData['serial_number'];
        $equipment->state_of_equipment = 'available'; // Set default value here
        $equipment->department_id = Auth::user()->department_id;
        $equipment->save();

        return redirect()->route('engineer.inventory')->with('success', 'Equipment added successfully.');
    }

    // **View Pending Faults for Approval**
    public function viewFaults()
    {
        $departmentId = Auth::user()->department_id;

        // Fetch faults in the engineer's department with 'Pending' status
        $faults = Fault::where('department_id', $departmentId)
                        ->where('status', 'Pending')
                        ->get();

        return view('engineer.faults', compact('faults'));
    }

    // **Approve or Deny Fault Report**
    public function updateFaultStatus(Request $request, $faultId)
    {
        $request->validate([
            'status' => 'required|in:Approved,Denied',
        ]);

        $fault = Fault::findOrFail($faultId);
        $fault->status = $request->status;
        $fault->save();

        // If approved, create a work order
        if ($request->status === 'Approved') {
            WorkOrder::create([
                'fault_report_id' => $fault->id, // Adjust to the correct foreign key
                'status' => 'Pending',
            ]);
        }

        return redirect()->route('engineer.viewFaults')->with('success', 'Fault status updated successfully.');
    }

    // **View Assigned Work Orders**
    public function workOrders()
    {
        $departmentId = Auth::user()->department_id;

        // Fetch work orders with related fault reports and equipment details
        $workOrders = WorkOrder::with(['faultReport', 'equipment'])
            ->whereHas('faultReport', function ($query) use ($departmentId) {
                $query->where('department_id', $departmentId);
            })
            ->get();

        return view('engineer.workorders', compact('workOrders'));
    }

    // **Update Work Order Status**
    public function updateWorkOrderStatus(Request $request, $workOrderId)
    {
        $request->validate([
            'status' => 'required|in:Pending,In Progress,Completed',
            'repair_description' => 'nullable|string',
        ]);

        $workOrder = WorkOrder::findOrFail($workOrderId);
        $workOrder->status = $request->status;
        $workOrder->repair_description = $request->repair_description;
        $workOrder->save();

        return redirect()->route('engineer.work_orders')->with('success', 'Work order status updated successfully.');
    }

    public function approveWorkOrder(Request $request, $workOrderId)
    {
        // Find the work order by ID
        $workOrder = WorkOrder::findOrFail($workOrderId);

        // Update the work order status to approved
        $workOrder->status = 'approved';  // Make sure 'approved' is in your enum options
        $workOrder->save();

        // Redirect back with success message
        return redirect()->route('engineer.work_orders')->with('success', 'Work order approved successfully.');
    }

    public function denyWorkOrder(Request $request, $workOrderId)
    {
        // Find the work order by ID
        $workOrder = WorkOrder::findOrFail($workOrderId);

        // Update the work order status to denied
        $workOrder->status = 'Denied';
        $workOrder->save();

        // Redirect back with a success message
        return redirect()->route('engineer.work_orders')->with('success', 'Work order denied successfully.');
    }

    public function reports()
    {
        // Fetch the work orders and any other relevant reports
        $workOrders = WorkOrder::where('engineer_id', auth()->id())->get();

        // Return a view, passing the work orders
        return view('engineer.reports', compact('workOrders'));
    }

    public function storeWorkOrderReport(Request $request)
    {
        $validatedData = $request->validate([
            'work_order_id' => 'required|exists:work_orders,id',
            'report_description' => 'required|string|max:1000',
        ]);
        $workOrders = WorkOrder::all();

        // Store the report as necessary (this could be in a separate model)
        // For example:
        // WorkOrderReport::create([
        //     'work_order_id' => $validatedData['work_order_id'],
        //     'description' => $validatedData['report_description'],
        //     'engineer_id' => auth()->id(),
        // ]);

        return redirect()->route('engineer.reports')->with('success', 'Work order report submitted successfully.');
    }

    public function storeWeeklyReport(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'report_content' => 'required|string|max:1000', // Adjust validation rules as necessary
            // Add other fields as necessary
        ]);

        // Create a new weekly report
        WeeklyReport::create([
            'report_content' => $validatedData['report_content'],
            'engineer_id' => auth()->id(), // Assuming you're associating it with the logged-in engineer
            'created_at' => now(), // Optional: Set the creation date
        ]);

        // Redirect with a success message
        return redirect()->route('engineer.reports')->with('success', 'Weekly report submitted successfully.');
    }

    public function removeEquipment($id)
{
    // Find the equipment by its ID
    $equipment = Equipment::findOrFail($id);

    // Ensure the equipment belongs to the currently authenticated user's department
    if ($equipment->department_id != Auth::user()->department_id) {
        return redirect()->route('engineer.inventory')->with('error', 'You do not have permission to remove this equipment.');
    }

    // Delete the equipment
    $equipment->delete();

    // Redirect back to the inventory page with a success message
    return redirect()->route('engineer.inventory')->with('success', 'Equipment removed successfully.');
}

public function deleteEquipment($id)
{
    $equipment = Equipment::findOrFail($id);
    $equipment->delete();

    return redirect()->route('engineer.inventory')
                     ->with('success', 'Equipment removed successfully.');
}

}

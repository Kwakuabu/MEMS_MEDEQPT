<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    public function index()
    {
        $equipment = Equipment::all();
        return view('equipment.index', compact('equipment'));
    }

    public function create()
    {
        return view('equipment.create');
    }

    public function store(Request $request)
    {
        // Validate and create new equipment
    }

    public function show(Equipment $equipment)
    {
        // Show specific equipment details
    }

    public function edit(Equipment $equipment)
    {
        // Show the form for editing equipment
    }

    public function update(Request $request, Equipment $equipment)
    {
        // Validate and update equipment
    }

    public function destroy(Equipment $equipment)
    {
        // Delete equipment
    }
}

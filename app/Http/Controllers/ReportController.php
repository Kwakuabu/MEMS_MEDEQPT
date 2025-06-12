<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::all();
        return view('reports.index', compact('reports'));
    }

    public function create()
    {
        return view('reports.create');
    }

    public function store(Request $request)
    {
        // Validate and create a new report
    }

    public function show(Report $report)
    {
        // Show specific report details
    }

    public function edit(Report $report)
    {
        // Show the form for editing a report
    }

    public function update(Request $request, Report $report)
    {
        // Validate and update report
    }

    public function destroy(Report $report)
    {
        // Delete report
    }
}

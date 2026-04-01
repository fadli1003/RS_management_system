<?php

namespace App\Http\Controllers;

use App\Models\LapReport;
use App\Http\Requests\StoreLapReportRequest;
use App\Http\Requests\UpdateLapReportRequest;

class LapReportController extends Controller
{
    public function index()
    {
      return view('lap.lapReports.index', ['lapReports' => LapReport::all()]);
    }

    public function create()
    {
      return view('lap.lapReports.create');
    }

    public function store(StoreLapReportRequest $request)
    {
      LapReport::create($request->validated());
      session()->flash('success', 'Lap report created successfully.');
      return redirect()->route('lap-reports.index');
    }

    public function show(LapReport $lapReport)
    {
      return view('lap.lapReports.index', compact('lapReport'));
    }

    public function edit(LapReport $lapReport)
    {
      return view('lap.lapReports.edit', compact('lapReport'));
    }

    public function update(UpdateLapReportRequest $request, LapReport $lapReport)
    {
      $lapReport->update($request->validated());
      return redirect()->intended(route('lap-reports.index'))->with(session('success', 'Lap report updated successfully.'));
    }

    public function destroy(LapReport $lapReport)
    {
      $lapReport->delete();
      session()->flash('success', 'Lap Report deleted successfully.');
    }
}

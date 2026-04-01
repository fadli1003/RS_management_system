<?php

namespace App\Http\Controllers;

use App\Models\Lap;
use App\Http\Requests\StoreLapRequest;
use App\Http\Requests\UpdateLapRequest;

class LapController extends Controller
{
    public function index()
    {
      return view('lap.lapTemplates.index', ['lapTemplates' => Lap::all()]);
    }

    public function create()
    {
      return view('lap.lapTemplates.create');
    }

    public function store(StoreLapRequest $request)
    {
      Lap::create($request->validated());
      return session('success', 'Lap templates created successfully.');
    }

    public function show(Lap $lap)
    {
      return view('lap.lapTemplates.index', compact('lap'));
    }

    public function edit(Lap $lap)
    {
      return view('lap.lapTemplates.edit', compact('lap'));
    }

    public function update(UpdateLapRequest $request, Lap $lap)
    {
      $lap->update($request->validated());
      return redirect()->route('lap-templates.index')->with(session()->flash('success', 'Lap templates updated successfully'));
    }

    public function destroy(Lap $lap)
    {
      $lap->delete();
      session()->flash('success', 'Lap template deleted successfully.');
    }
}

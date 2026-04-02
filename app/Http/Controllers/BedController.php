<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Http\Requests\StoreBedRequest;
use App\Http\Requests\UpdateBedRequest;

class BedController extends Controller
{
    public function index()
    {
      return view('bedAllotment.beds.index', [
        'beds' => Bed::all()
      ]);
    }

    public function create()
    {
      return view('bedAllotment.beds.index', [
        'beds' => Bed::all()
      ]);
    }

    public function store(StoreBedRequest $request)
    {
      $data = $request->validated();

      Bed::create($data);
      session()->flash('success', 'Bed added successfully.');

      return redirect()->intended(route('beds.index'));
    }

    public function show(Bed $bed)
    {
      return view('bedAllotment.beds.show', compact('bed'));
    }

    public function edit(Bed $bed)
    {
      return view('bedAllotment.beds.edit', compact('bed'));
    }

    public function update(UpdateBedRequest $request, Bed $bed)
    {
      $data = $request->validated();
      $bed->update($data);
      session()->flash('success', 'Bed updated successfully.');
      return redirect()->intended(route('beds.index'));
    }

    public function destroy(Bed $bed)
    {
      $bed->delete();
      session()->flash('success', 'Bed deleted successfully.');

      return redirect()->intended(route('beds.index'));
    }
}

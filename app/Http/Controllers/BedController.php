<?php

namespace App\Http\Controllers;

use App\Models\Bed;
use App\Http\Requests\StoreBedRequest;
use App\Http\Requests\UpdateBedRequest;

class BedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      return view('bedAllotment.beds.index', [
        'beds' => Bed::all()
      ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('bedAllotment.beds.index', [
        'beds' => Bed::all()
      ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBedRequest $request)
    {
      $data = $request->validated();

      Bed::create($data);
      session()->flash('success', 'Bed added successfully.');

      return redirect()->intended(route('beds.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Bed $bed)
    {
      return view('bedAllotment.beds.show', compact('bed'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Bed $bed)
    {
      return view('bedAllotment.beds.edit', compact('bed'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBedRequest $request, Bed $bed)
    {
      $data = $request->validated();
      $bed->update($data);
      session()->flash('success', 'Bed updated successfully.');
      return redirect()->intended(route('beds.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Bed $bed)
    {
      $bed->delete();
      session()->flash('success', 'Bed deleted successfully.');

      return redirect()->intended(route('beds.index'));
    }
}

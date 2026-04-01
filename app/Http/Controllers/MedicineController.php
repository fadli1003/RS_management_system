<?php

namespace App\Http\Controllers;

use App\Models\Medicine;
use App\Http\Requests\StoreMedicineRequest;
use App\Http\Requests\UpdateMedicineRequest;

class MedicineController extends Controller
{
  public function index()
  {
    return view('medicines.index', ['medicines' => Medicine::all()]);
  }

  public function create()
  {
    return view('medicines.create');
  }

  public function store(StoreMedicineRequest $request)
  {
    Medicine::create($request->validated());
    return redirect()->route('medicines.index')->with(session()->flash('success', 'New Medicine created successfully.'));
  }

  public function show(Medicine $medicine)
  {
    return view('medicines.index', compact('medicine'));
  }

  public function edit(Medicine $medicine)
  {
    return view('medicines.edit', compact('medicine'));
  }

  public function update(UpdateMedicineRequest $request, Medicine $medicine)
  {
    $medicine->update($request->validated());
    return redirect()->route('medicines.index')->with('success', 'Medicine updated successfully.');
  }

  public function destroy(Medicine $medicine)
  {
    $medicine->delete();
    session()->flash('success', 'Medicine deleted successfully');
  }
}

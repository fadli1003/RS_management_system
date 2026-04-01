<?php

namespace App\Http\Controllers;

use App\Models\Departement;
use App\Http\Requests\StoreDepartementRequest;
use App\Http\Requests\UpdateDepartementRequest;

class DepartementController extends Controller
{

    public function index()
    {
      return view('departements.index', [
        'departements' => Departement::all()
      ]);
    }

    public function create()
    {
      return view('departements.create');
    }

    public function store(StoreDepartementRequest $request)
    {
      Departement::create($request->validated());
      session()->flash('success', 'New Department created successfully.');

      return redirect()->route('departements.index')->status(201);
    }

    public function show(Departement $departement)
    {
        return view('departements.index', [
          'departement' => $departement
        ]);
    }

    public function edit(Departement $departement)
    {
      return view('departements.edit', [
        'department' => $departement
      ]);
    }

    public function update(UpdateDepartementRequest $request, Departement $departement)
    {
      $departement->update($request->validated());
      return redirect()->route('departements.index')->with(session()->flash('success', 'Department updated successfully.'));
    }

    public function destroy(Departement $departement)
    {
      $name = $departement->name;
      $departement->delete();
      return back(200)->with(session()->flash('success', 'Department' .$name .'deleted successfully.'));
    }
}

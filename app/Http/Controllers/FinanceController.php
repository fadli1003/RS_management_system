<?php

namespace App\Http\Controllers;

use App\Models\Finance;
use App\Http\Requests\StoreFinanceRequest;
use App\Http\Requests\UpdateFinanceRequest;

class FinanceController extends Controller
{
  public function index()
  {
    return view('financial.index', [
      'finances' => Finance::all()
    ]);
  }

  public function create()
  {
    return view('financial.create');
  }

  public function store(StoreFinanceRequest $request)
  {
    Finance::create($request->validated());
    return redirect()->intended()->with(session()->flash('success', 'Finance created successfully.'));
  }

  public function show(Finance $finance)
  {
    return view('financial.index', compact('finance'));
  }

  public function edit(Finance $finance)
  {
    return view('financial.edit', compact('finance'));
  }

  public function update(UpdateFinanceRequest $request, Finance $finance)
  {
    $finance->update($request->validated());
    return redirect()->intended(route('finances.index'))->with('success', 'Finance information updated successfully.');
  }

  public function destroy(Finance $finance)
  {
    $finance->delete();
    session()->flash('success', 'Finance information deleted successfully.');
    return redirect()->back(200);
  }
}

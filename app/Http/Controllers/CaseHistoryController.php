<?php

namespace App\Http\Controllers;

use App\Models\CaseHistory;
use App\Http\Requests\StoreCaseHistoryRequest;
use App\Http\Requests\UpdateCaseHistoryRequest;
use App\Models\User;

class CaseHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
      return view('caseHistories.index', [
        'caseHistories' => CaseHistory::with('users')->get()
      ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      return view('caseHistories.index', [
        // 'caseHistories' => CaseHistory::all(),
        'patients' => User::patient()->get()
      ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCaseHistoryRequest $request)
    {
      $data = $request->validated();
      CaseHistory::create($data);
      session()->flash('success', 'Case History created successfully.');

      return redirect()->intended(route('caseHistories.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(CaseHistory $caseHistory)
    {
      return view('caseHistories.show', [
        'caseHistory' => $caseHistory->with('users')
      ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CaseHistory $caseHistory)
    {
      return view('caseHistories.edit', [
        'caseHistorie' => $caseHistory->with('users'),
        'patients' => User::patient()->get()
      ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCaseHistoryRequest $request, CaseHistory $caseHistory)
    {
      $data = $request->validated();
      $caseHistory->update($data);
      $patientName = $data['patient_name'];
      session()->flash('success', $patientName. 'Case History updated successfully.');
      return redirect()->intended(route('case-histories.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CaseHistory $caseHistory)
    {
      $caseHistory->delete();
      session()->flash('success', 'Case History deleted successfully.');
      return redirect()->intended(route('case-histories.index'));
    }
}

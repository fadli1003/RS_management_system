<?php

namespace App\Http\Controllers;

use App\Models\CaseHistory;
use App\Http\Requests\StoreCaseHistoryRequest;
use App\Http\Requests\UpdateCaseHistoryRequest;

class CaseHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCaseHistoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(CaseHistory $caseHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CaseHistory $caseHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCaseHistoryRequest $request, CaseHistory $caseHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CaseHistory $caseHistory)
    {
        //
    }
}

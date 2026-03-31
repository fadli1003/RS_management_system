<?php

namespace App\Http\Controllers;

use App\Models\DayoffSchedule;
use App\Http\Requests\StoreDayoffScheduleRequest;
use App\Http\Requests\UpdateDayoffScheduleRequest;
use Illuminate\Http\Request;

class DayoffScheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
      $query = DayoffSchedule::query();

      if(isset($request->start_date) && empty($request->end_date)){
        $query->whereBetween('date', [$request->start_date, now()]);
      }
      if(empty($request->start_date) && isset($request->end_date)){
        $query->where('date', '<' , $request->end_date);
      }

      if(isset($request->start_date) && isset($request->end_date)) {
        $query->whereBetween('date', [$request->start_date, $request->end_date])->get();
      }

      return view('timeSchedules.DayoffSchedules.index', [
        'dayOffSchedules' => $query->get()
      ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreDayoffScheduleRequest $request)
    {
      $data = $request->validated();
      DayoffSchedule::create($data);
      session()->flash('success', 'Day off schedule added successfully.');

      return redirect()->intended(route('days-off-schedules.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(DayoffSchedule $dayoffSchedule)
    {
      $dayoffSchedule->with('users');
      return view('timeSchedules.DayoffSchedules.show', compact('dayoffSchedule'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(DayoffSchedule $dayoffSchedule)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateDayoffScheduleRequest $request, DayoffSchedule $dayoffSchedule)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DayoffSchedule $dayoffSchedule)
    {
        //
    }
}

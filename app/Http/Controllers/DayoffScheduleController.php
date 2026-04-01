<?php

namespace App\Http\Controllers;

use App\Models\DayoffSchedule;
use App\Http\Requests\StoreDayoffScheduleRequest;
use App\Http\Requests\UpdateDayoffScheduleRequest;
use App\Models\User;
use Illuminate\Http\Request;

class DayoffScheduleController extends Controller
{
  public function index()
  {
    return view('timeSchedules.DayoffSchedules.index', [
      'dayOffSchedules' => DayoffSchedule::with('users:id,name,department_id')->get(),
    ]);
  }

  public function getDayOffSchedule(Request $request)
  {
    $query = DayoffSchedule::query();

    if (isset($request->start_date) && empty($request->end_date)) {
      $query->whereBetween('date', [$request->start_date, now()]);
    }
    if (empty($request->start_date) && isset($request->end_date)) {
      $query->where('date', '<', $request->end_date);
    }

    if (isset($request->start_date) && isset($request->end_date)) {
      $query->whereBetween('date', [$request->start_date, $request->end_date])->get();
    }

    return redirect()->intended(route('days-off-schedules.index'))->with('dayOffSchedules', $query->get());
  }

  public function create()
  {
    return view('timeSchedules.DayoffSchedules.create', [
      'dayOffSchedules' => DayoffSchedule::with('users:department_id')->get('user_id', 'date')
    ]);
  }

  public function store(StoreDayoffScheduleRequest $request)
  {

    $data = $request->validated();
    $department_id = User::findOrFail($data['user_id'])->get('department_id');

    $doctorOff = DayoffSchedule::where('user_id', function ($q) use ($department_id) {
      $q->where('departement_id', $department_id);
    })->where('date', $request->date)->count();

    $doctorSpecialist = User::where('departement_id', $department_id)->count();

    if(($doctorOff + 1) >= $doctorSpecialist){
      return redirect()->back(422)->with('errors', 'Semua doctor pada departement ini mempunyai day off pada hari yang sama. Departement tidak boleh kosong');
    }

    DayoffSchedule::create($data);
    session()->flash('success', 'Day off schedule added successfully.');

    return redirect()->intended(route('days-off-schedules.index'));
  }

  public function show(DayoffSchedule $dayoffSchedule)
  {
    $dayoffSchedule->with('users');
    return view('timeSchedules.DayoffSchedules.index', compact('dayoffSchedule'));
  }

  public function edit(DayoffSchedule $dayoffSchedule)
  {
    return view('timeSchedules.DayoffSchedules.edit', [
      'dayOffSchedule' => $dayoffSchedule
    ]);
  }

  public function update(UpdateDayoffScheduleRequest $request, DayoffSchedule $dayoffSchedule)
  {
    $data = $request->validated();
    $department_id = User::findOrFail($data['user_id'])->get('department_id');

    $doctorOff = DayoffSchedule::where('user_id', function ($q) use ($department_id) {
      $q->where('departement_id', $department_id);
    })->where('date', $request->date)->count();

    $doctorSpecialist = User::where('departement_id', $department_id)->count();

    if(($doctorOff + 1) >= $doctorSpecialist){
      return redirect()->back(422)->with('errors', 'Semua doctor pada departement ini mempunyai day off pada hari yang sama. Departement tidak boleh kosong');
    }

    $dayoffSchedule->update($data);
    session()->flash('success', 'Day off schedule updated successfully.');

    return redirect()->intended(route('days-off-schedules.index'), 200);
  }

  public function destroy(DayoffSchedule $dayoffSchedule)
  {
    $dayoffSchedule->delete();
    return redirect()->back()->with(session()->flash('success', 'Day off schedule deleted successfully.'));
  }
}

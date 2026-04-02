<?php

namespace App\Http\Controllers;

use App\Models\BedAllotment;
use App\Http\Requests\StoreBedAllotmentRequest;
use App\Http\Requests\UpdateBedAllotmentRequest;
use App\Models\Bed;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BedAllotmentController extends Controller
{
  public function index()
  {
    return view('bedAllotment.index')->with('bedAllotments', BedAllotment::all());
  }

  public function getBedAllotmentsByDate(Request $request)
  {
    if ($request->start && $request->end) {
      //$bedallotments = BedAllotment::all();
      $TS = collect();
      $arr = [];
      foreach (BedAllotment::all() as $bedAllotment) {
        $start_date_time = $bedAllotment->start_date . ' ' . $bedAllotment->start_time;
        $end_date_time = $bedAllotment->end_date . ' ' . $bedAllotment->end_time;
        
        if (Carbon::parse($request->start)->between($start_date_time, $end_date_time) || Carbon::parse($request->end)->between($start_date_time, $end_date_time)) {
          array_push($arr, $bedAllotment->bed_id);
        }
      }

      foreach (Bed::all() as $bed) {
        if ($bed->status != 'Unavailable') {
          if (count($arr) > 0) {
            for ($i = 0; $i < count($arr); $i++) {
              if ($bed->id != $arr[$i]) {
                $TS->push($bed);
              }
            }
          } else {
            $TS->push($bed);
          }
        }
      }

      $json = $TS->toJson();
    }

    return response()->json(['html' => $json]);
  }

  public function create()
  {
    return view('bedAllotments.create')->with('beds', Bed::all())->with('patients', User::patient()->get());
  }

  public function store(StoreBedAllotmentRequest $request)
  {
    $newBed = $request->validated();
    $newBed['status'] = 'incoming';
    BedAllotment::create($newBed);
    session()->flash('success', 'New Bed Allotment added successfully.');
    return redirect()->route('bedAllotment.index');
  }

  public function show(BedAllotment $bedAllotment)
  {
    return view('bedAllotment.show')->with('bedAllotment', $bedAllotment);
  }

  public function edit(BedAllotment $bedAllotment)
  {
    $patient = User::patient()->get();
    $beds = Bed::all();
    return view('bedAllotment.edit', compact('patient', 'bedAllotment', 'beds'));
  }

  public function update(UpdateBedAllotmentRequest $request, BedAllotment $bedAllotment)
  {
    $data = $request->validated();
    $bedAllotment->update($data);
    session()->flash('success', 'Bed Allotment updated succesfully.');

    return redirect()->route('bedAllotment.index');
  }

  public function destroy(BedAllotment $bedAllotment)
  {
    $bedAllotment->delete();
    session()->flash('success', 'Bed Allotment deleted successfully.');
    return redirect(route('bedAllotment.index'));
  }
}

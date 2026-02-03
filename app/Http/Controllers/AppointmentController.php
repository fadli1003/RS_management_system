<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Http\Requests\StoreAppointmentRequest;
use App\Http\Requests\UpdateAppointmentRequest;
use App\Models\Departement;
use App\Models\Finance;
use App\Models\Payment;
use App\Models\TimeSchedule;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AppointmentController extends Controller
{
  public function getAppointmentsByDate(Request $request)
  {
    if ($request->date) {
      $app = Appointment::where('date', $request->date)->get();
      foreach ($app as $a) {
        collect()->push($a);
      }
      $json = collect()->toJson();
    }
    return response()->json(['html' => $json]);
  }

  public function getDoctorsByDepartment(Request $request)
  {
    if ($request->id) {
      $html = '<option value="">Please Select Doctor</option>';
      $department = Departement::find($request->id);
      $doctors = $department->doctors;
      foreach ($doctors as $doctor) {

        $html .= '<option value="' . $doctor->id . '">' . $doctor->first_name . ' ' . $doctor->last_name . '</option>';
      }
    }
    return response()->json(['html' => $html]);
  }

  public function index()
  {
    foreach (Appointment::all() as $appointment) {

      $date_time = $appointment->date . ' ' . $appointment->time;
      //$end_date_time = $appointment->end_date.' '.$appointment->end_time;

      //$bed = $appointment->bed;
      if (Carbon::parse($date_time)->lt(now()) && $appointment->status == 'confirmed') {
        $appointment->update([
          'status' => 'Treated'
        ]);
      } else if (Carbon::parse($date_time)->lt(now()) && $appointment->status == 'pending') {
        $appointment->update([
          'status' => 'cancelled'
        ]);
      }
    }

    $pending = Appointment::where('status', 'pending')->get();
    $confirmed = Appointment::where('status', 'confirmed')->get();
    $cancelled = Appointment::where('status', 'cancelled')->get();
    $treated = Appointment::where('status', 'treated')->get();
    $appointments = Appointment::all();

    return view('appointments.list', compact('pending', 'confirmed', 'cancelled', 'treated', 'appointments'));
  }

  public function create()
  {

    $doctors = User::doctor()->get();
    $patients = User::patient()->get();
    $departments = Departement::all();
    $timeschedules = TimeSchedule::all();

    return view('appointments.create', compact('doctors', 'patients', 'departments', 'timeschedules'));
  }

  public function store(StoreAppointmentRequest $request)
  {
    $data = $request->validated();

    if ($request->patient !== 0) {
      $patient = $request->patient;
    } else {
      $patient = User::create([
        'first_name' => $request->first_name,
        'last_name' => $request->last_name,
        'email' => 'default@clinic.com',
        'password' => Hash::make('password'),
        'role' => 'patient'
      ]);
    }

    $data['patient'] = $patient;

    Appointment::create($data);

    if ($request->status == 'confirmed') {
      if (strpos($request->commission, '%') !== false) {
        $c = str_replace('%', '', $request->commission);
        $commission = $request->price * $c / 100;
      } else {
        $commission = $request->commission;
      }
      $payment = Payment::create([
        'doctor_id' => $request->doctor,
        'patient_id' => $request->patient,
        'sub_total' => $request->price,
        'taxes' => 0,
        'total' => $request->price,
        'amount_received' => $request->price,
        'amount_to_pay' => 0,
        'doctor_commission' => $commission,
      ]);

      $payment->paymentitems()->attach($request->item, ['payment_item_quantity' => 1]);

      $f = Finance::find(1);
      $t = $f->total_money;
      $f->update([
        'total_money' => $t + $request->price,
      ]);
    }

    session()->flash('success', 'New Appointment Added Successfully.');

    return redirect(route('appointments.index'));
  }

  public function show(Appointment $appointment)
  {
    return view('appointments.show', compact('appointment'));
  }

  public function edit(Appointment $appointment)
  {
    $doctors = User::doctor()->get();
    $patients = User::patient()->get();
    $departments = Departement::all();
    $timeschedules = TimeSchedule::all();

    return view('appointments.create', compact('doctors', 'patients', 'appointment', 'departments', 'timeschedules'));
  }

  public function update(UpdateAppointmentRequest $request, Appointment $appointment)
  {
    $data = $request->validated();
    $appointment->update($data);

    session()->flash('success', 'Time Schedule Updated Successfully.');

    return redirect(route('appointments.index'));
  }

  public function destroy(Appointment $appointment)
  {
    $appointment->delete();

    session()->flash('success', 'Time Schedule Deleted Successfully.');

    return redirect(route('appointments.index'));
  }

  public function createAppointmentForDoctor(User $doctor)
  {
    return view('appointments.create', compact('doctor'));
  }

  public function appointmentsForDoctor(User $doctor)
  {
    return view('appointments.list', compact('doctor'));
  }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountantRequest;
use App\Models\Departement;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AccountantController extends Controller
{
  public function index()
  {
    $accountants = User::accountant()->get();
    $departements = Departement::all();

    return view('users.accountants.list', compact('accountants',));
  }

  public function create()
  {
    $departements = Departement::all();
    return view('users.accountants.create', compact('departements'));
  }

  public function store(AccountantRequest $request)
  {
    $data = $request->validated();
    $data['password'] = Hash::make($data['password']);
    $data['role'] = 'accountant';

    $accountant = User::create($data);
    if ($request->picture) {
      $pic = $request->picture->store('accountants_pictures');
      $accountant->picture = $pic;
      $accountant->save();
    }

    if ($request->departments) {
      $accountant->departments()->attach($request->departments);
    }

    session()->flash('success', 'New Accountant Added Successfully.');

    return redirect()->route('accountants.index');
  }

  public function show(User $AccountantId, Departement $departements)
  {
    return view('users.accountants.show', compact('accountantId', 'departements'));
  }

  public function edit(User $AccountantId, Departement $departements)
  {
    return view('users.accountants.show', compact('accountantId', 'departements'));
  }

  public function update(AccountantRequest $request, User $accountant)
  {
    $data = $request->validated();

    if ($request->hasFile('picture')) {
      $pic = $request->picture->store('accountants_pictures');

      Storage::delete($accountant->picture);

      $data['picture'] = $pic;
    }

    if ($request->departments) {
      $accountant->departments()->sync($request->departments);
    }

    $accountant->update($data);

    session()->flash('success', 'Accountant Info Updated Successfully.');

    return redirect(route('accountants.index'));
  }

  public function destroy(User $accountant)
  {
    $accountant->departments()->detach();
    $accountant->timeSchedules()->delete();
    Storage::delete($accountant->picture);
    $accountant->delete();

    session()->flash('success', 'Accountant Deleted Successfully.');
    
    return redirect(route('accountants.index'));
  }
}

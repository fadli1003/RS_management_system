<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;

class PaymentController extends Controller
{
    public function index()
    {
      return view('financial.payments.index', ['payments' => Payment::all()]);
    }

    public function create()
    {
      return view('financial.payments.create');
    }

    public function store(StorePaymentRequest $request)
    {
      Payment::create($request->validated());
      return redirect()->route('payments.index')->with('success', 'Payment created successfully.');
    }

    public function show(Payment $payment)
    {
      return view('payments.index', compact('payment'));
    }

    public function edit(Payment $payment)
    {
      return view('financial.payments.edit', compact('payment'));
    }

    public function update(UpdatePaymentRequest $request, Payment $payment)
    {
      $payment->update($request->validated());
      return redirect()->route('payments.index')->with(session()->flash('success', 'Payment updated successfuly'));
    }

    public function destroy(Payment $payment)
    {
      $payment->delete();
      session()->flash('success', 'Payment info deleted successfully');
    }
}

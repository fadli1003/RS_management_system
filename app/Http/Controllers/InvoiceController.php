<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Http\Requests\StoreInvoiceRequest;
use App\Http\Requests\UpdateInvoiceRequest;

class InvoiceController extends Controller
{
    public function index()
    {
      return view('invoices.index', [
        'invoces' => Invoice::all()
      ]);
    }

    public function create()
    {
      return view('invoices.create');
    }

    public function store(StoreInvoiceRequest $request)
    {
      Invoice::create($request->validated());
      return redirect()->intended(route('invoinces.index'))->with('success', 'New Invoice created successfully.');
    }

    public function show(Invoice $invoice)
    {
      return view('invoices.index', compact('invoices'));
    }

    public function edit(Invoice $invoice)
    {
      return view('invoices.edit', compact('invoice'));
    }

    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
      $invoice->update($request->validated());
      return redirect()->intended(route('invoinces.index'))->with('success', 'invoice updated successfully');
    }

    public function destroy(Invoice $invoice)
    {
      $invoice->delete();
      return session()->flash('success', 'Invoice deleted successfully');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Requests\UpdateExpenseRequest;

class ExpenseController extends Controller
{
    public function index()
    {
      return view('financial.expense.index', [
        'expenses' => Expense::all()
      ]);
    }

    public function create()
    {
      return view('financial.expense.create', [
        'expenses' => Expense::all()
      ]);
    }

    public function store(StoreExpenseRequest $request)
    {
      Expense::create($request->validated());
      return redirect()->route('expenses.index')->with(session()->flash('success', 'New Expense created successfully.'));
    }

    public function show(Expense $expense)
    {
      return view('financial.expense.index', [
        'expense' => $expense
      ]);
    }

    public function edit(Expense $expense)
    {
      return view('financial.expense.edit', [
        'expense' => $expense
      ]);
    }

    public function update(UpdateExpenseRequest $request, Expense $expense)
    {
      $expense->update($request->validated());

      return redirect()->route('expenses.index')->with(session()->flash('success', 'Expense information updated successfully.'));
    }

    public function destroy(Expense $expense)
    {
      $expense->delete();
      session()->flash('success', 'Expense info deleted successfully.');

      return redirect()->intended(route('expenses.index'));
    }
}

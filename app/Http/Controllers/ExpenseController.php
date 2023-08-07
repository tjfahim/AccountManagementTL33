<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::all();
        return view('admin.expenses', compact('expenses'));
    }

    // Show the form for creating a new expense
    public function create()
    {
        return view('expenses.create');
    }

    // Store a newly created expense in the database
    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'category' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'account' => 'nullable|string',
            'detail' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        Expense::create($request->all());
        return redirect()->route('expenses.index')->with('success', 'Expense created successfully.');
    }

    // Display the specified expense
    public function show(Expense $expense)
    {
        return view('expenses.show', compact('expense'));
    }

    // Show the form for editing the specified expense
    public function edit(Expense $expense)
    {
        return view('expenses.edit', compact('expense'));
    }

    // Update the specified expense in the database
    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'date' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'category' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'account' => 'nullable|string',
            'detail' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        $expense->update($request->all());
        return redirect()->route('expenses.index')->with('success', 'Expense updated successfully.');
    }

    // Remove the specified expense from the database
    public function destroy(Expense $expense)
    {
        $expense->delete();
        return redirect()->route('expenses.index')->with('success', 'Expense deleted successfully.');
    }
}

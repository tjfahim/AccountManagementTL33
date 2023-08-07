<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index()
    {
        $incomes = Income::all();
        $activeCategories = Category::where('status', 'active')->get();
        return view('admin.incomes', compact('incomes','activeCategories'));
    }

    // Show the form for creating a new income
    public function create()
    {
        // Add logic to populate any necessary data, e.g., categories, accounts, etc.
        return view('incomes.create');
    }

    // Store a newly created income in the database
    public function store1(Request $request)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'category' => 'nullable|string',
            'amount' => 'required|numeric',
            'account' => 'nullable|string',
            'detail' => 'nullable|string',
            'status' => 'nullable|string',
        ]);
    
        if ($validatedData) {
            $income = new Income();
            $income->date = $request->input('date');
            $income->user_id = auth()->id();
            $income->category = $request->input('category');
            $income->amount = $request->input('amount');
            $income->account = $request->input('account');
            $income->detail = $request->input('detail');
            $income->status = 'active';
            $income->save();
    
            return redirect()->route('income.index');
        } else {
            return redirect()->back()->withErrors($validatedData)->withInput();
        }
    }
   
    

    // Display the specified income
    public function show(Income $income)
    {
        return view('incomes.show', compact('income'));
    }

    // Show the form for editing the specified income
    public function edit(Income $income)
    {
        // Add logic to populate any necessary data, e.g., categories, accounts, etc.
        return view('incomes.edit', compact('income'));
    }

    // Update the specified income in the database
    public function update(Request $request, Income $income)
    {
        $validatedData = $request->validate([
            'date' => 'required|date',
            'user_id' => 'required|exists:users,id',
            'category' => 'nullable|string',
            'amount' => 'required|numeric',
            'account' => 'nullable|string',
            'detail' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        $income->update($validatedData);

        // Optionally, you can add some flash message to notify the user about the successful update.

        return redirect()->route('incomes.index');
    }

    // Remove the specified income from the database
    public function destroy(Income $income)
    {
        $income->delete();

        // Optionally, you can add some flash message to notify the user about the successful deletion.

        return redirect()->route('incomes.index');
    }
}

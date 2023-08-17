<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Income;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    public function index()
    {
        $incomes = Income::orderBy('created_at', 'desc')->paginate(10);
        $activeCategories = Category::where('status', 'active')->get();
        return view('admin.incomes', compact('incomes','activeCategories'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'date' => 'required|date',
                'category' => 'nullable|string',
                'amount' => 'required|numeric',
                'account' => 'nullable|string',
                'detail' => 'nullable|string',
            ]);
    
            // Ensure authentication is working and get authenticated user ID
            $user_id = auth()->id();
            if (!$user_id) {
                throw new \Exception('User authentication failed.');
            }
    
            $income = new Income();
            $income->date = $request->input('date');
            $income->user_id = $user_id;
            $income->category = $request->input('category');
            $income->amount = $request->input('amount');
            $income->account = $request->input('account');
            $income->detail = $request->input('detail');
            $income->status = 'active';
            $income->save();
    
            return redirect()->route('income.index')->with('success', 'Income Added Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
    
 
    public function edit(Income $income)
    {
        $activeCategories = Category::where('status', 'active')->get();
        return view('admin.income_edit', compact('income','activeCategories'));
    }

    // Update the specified category in the database
    public function update(Request $request, Income $income)
    {
        $request->validate([
            'date' => 'required|date',
            'category' => 'nullable|string',
            'amount' => 'required|numeric',
            'account' => 'nullable|string',
            'detail' => 'nullable|string',
           
        ]);

   
        $income->update([
            'date' => $request->input('date'),
            'category' => $request->input('category'),
            'amount' => $request->input('amount'),
            'account' => $request->input('account'),
            'detail' => $request->input('detail'),
        ]);        return redirect()->route('income.index')->with('success', 'Income updated successfully.');
    }

    // Remove the specified category from the database
    public function destroy(Income $income)
    {
        $income->delete();
        return redirect()->route('income.index')->with('success', 'Income deleted successfully.');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = Expense::with('user')->where('status', 'active')->orderBy('created_at', 'desc')->paginate(10); // 10 expenses per page
        $activeCategories = Category::where('status', 'active')->get();
        $totalAmount = $expenses->sum('amount');
        return view('admin.expenses', compact('expenses', 'activeCategories','totalAmount'));
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
    
            $expense = new Expense();
            $expense->date = $request->input('date');
            $expense->user_id = $user_id;
            $expense->category = $request->input('category');
            $expense->amount = $request->input('amount');
            $expense->account = $request->input('account');
            $expense->detail = $request->input('detail');
            $expense->status = 'active';
            $expense->save();
    
            return redirect()->route('expense.index')->with('success', 'Expense Added Successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
    
 
    public function edit(expense $expense)
    {
        $activeCategories = Category::where('status', 'active')->get();
        return view('admin.expense_edit', compact('expense','activeCategories'));
    }

    // Update the specified category in the database
    public function update(Request $request, Expense $expense)
    {
        $request->validate([
            'date' => 'required|date',
            'category' => 'nullable|string',
            'amount' => 'required|numeric',
            'account' => 'nullable|string',
            'detail' => 'nullable|string',
        ]);
    
        $expense->update([
            'date' => $request->input('date'),
            'category' => $request->input('category'),
            'amount' => $request->input('amount'),
            'account' => $request->input('account'),
            'detail' => $request->input('detail'),
        ]);
    
        return redirect()->route('expense.index')->with('success', 'Expense updated successfully.');
    }
    

    // Remove the specified category from the database
    public function delete(Expense $expense)
    {
        if ($expense) {
            $expense->status = 'deleted'; // Update the status
            $expense->save(); // Save the changes
            return redirect()->route('expense.index')->with('success', 'Expense deleted successfully.');
        } else {
            return redirect()->route('expense.index')->with('success', 'Expense not found.');
        }
    }
}

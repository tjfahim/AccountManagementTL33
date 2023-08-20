<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
    {
 
        $incomes = Income::with('user')->orderBy('created_at', 'desc')->paginate(10);
        
        $activeCategories = Category::where('status', 'active')->get();
        $cash_income = Income::where('account', 'cash')->get();
        $bank_income = Income::where('account', '!=', 'cash')->get();
        $totalAmountincome = $incomes->sum('amount');
        $totalAmountincome_cash = $cash_income->sum('amount');
        $totalAmountincome_bank = $bank_income->sum('amount');

        $expenses = Expense::with('user')->orderBy('created_at', 'desc')->paginate(10);
        $cash_expense = Expense::where('account', 'cash')->get();
        $bank_expense = Expense::where('account', '!=', 'cash')->get();
        $activeCategories = Category::where('status', 'active')->get();
        $totalAmountexpense = $expenses->sum('amount');  
        $totalAmountexpense_cash = $cash_expense->sum('amount');
        $totalAmountexpense_bank = $bank_expense->sum('amount');

        return view('admin.report', compact('incomes','activeCategories','totalAmountexpense','expenses', 'activeCategories','totalAmountincome','totalAmountincome_bank','totalAmountincome_cash','totalAmountexpense_cash','totalAmountexpense_bank'));

           
    
    }
}

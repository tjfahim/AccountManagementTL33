<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use App\Models\Income;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $category = $request->input('category');

        if (empty($fromDate) && empty($toDate)) {
            $fromDate = Carbon::now()->startOfMonth();
            $toDate = Carbon::now()->endOfMonth();
        } else {
            // Parse the provided dates using Carbon
            $fromDate = Carbon::parse($fromDate);
            $toDate = Carbon::parse($toDate);
        }

        $Incomequery = Income::whereBetween('date', [$fromDate, $toDate])
        ->where('status', 'active')
        ->orderBy('created_at', 'desc');
        if (!empty($category)) {
            $Incomequery->where('category', $category);
        }
        $Expensequery = Expense::whereBetween('date', [$fromDate, $toDate])
        ->where('status', 'active')
        ->orderBy('created_at', 'desc');
        if (!empty($category)) {
            $Expensequery->where('category', $category);
        }
        $incomessearch = $Incomequery->paginate(10);
        $Expensesearch = $Expensequery->paginate(10);

        $totalIncome = $incomessearch->sum('amount');
        $totalIncomeWithoutCash = $incomessearch->where('account', '!=', 'cash')->sum('amount');
        $totalIncomeWithCash = $incomessearch->where('account', 'cash')->sum('amount');

        $totalExpense = $Expensesearch->sum('amount');
        $totalexpenseWithoutCash = $Expensesearch->where('account', '!=', 'cash')->sum('amount');
        $totalexpenseWithCash = $Expensesearch->where('account', 'cash')->sum('amount');
        
        $availableTotal = $totalIncome - $totalExpense;
        $availableTotalcash = $totalIncomeWithCash - $totalexpenseWithCash;
        $availableTotalbank = $totalIncomeWithoutCash - $totalexpenseWithoutCash;

        $category_list=Category::get();
    
        return view('admin.report', compact('availableTotal','Expensesearch','totalExpense','totalIncome','totalIncomeWithoutCash','totalIncomeWithCash','totalexpenseWithoutCash','totalexpenseWithCash','availableTotalcash','availableTotalbank','incomessearch','category_list','fromDate','toDate','category'));
           
    
    }
}

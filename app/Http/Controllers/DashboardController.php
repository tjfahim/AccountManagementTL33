<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Expense;
use App\Models\Income;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $role = $user->role; // Get the user's role
    
            $currentMonth = Carbon::now()->month;

            $incomes = Income::with('user')
            ->whereMonth('created_at', $currentMonth)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

            $expenses = Expense::with('user')
            ->whereMonth('created_at', $currentMonth)
            ->orderBy('created_at', 'desc')
            ->paginate(10);

            $totalIncome = $incomes->sum('amount');
            $totalIncomeWithoutCash = $incomes->where('account', '!=', 'cash')->sum('amount');
            $totalIncomeWithCash = $incomes->where('account', 'cash')->sum('amount');

            $totalExpense = $expenses->sum('amount');
            $totalexpenseWithoutCash = $expenses->where('account', '!=', 'cash')->sum('amount');
            $totalexpenseWithCash = $expenses->where('account', 'cash')->sum('amount');
            
            $availableTotal = $totalIncome - $totalExpense;
            $availableTotalcash = $totalIncomeWithCash - $totalexpenseWithCash;
            $availableTotalbank = $totalIncomeWithoutCash - $totalexpenseWithoutCash;

            if ($role === 'admin') {
                return view('admin.dashboard', compact('availableTotal','totalExpense','totalIncome','totalIncomeWithoutCash','totalIncomeWithCash','totalexpenseWithoutCash','totalexpenseWithCash','availableTotalcash','availableTotalbank'));
            } elseif ($role === 'user') {
                return view('user.dashboard'); // Render the user dashboard view
            }
        }
        return redirect('/login');

           
    
    }
}

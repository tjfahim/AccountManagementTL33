<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ExpenseController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', function () {
    // Check if the user is authenticated
    if (Auth::check()) {
        $user = Auth::user();
        $role = $user->role; // Get the user's role

        // Check the user's role and redirect accordingly
        if ($role === 'admin') {
            return view('admin.dashboard'); // Render the admin dashboard view
        } elseif ($role === 'user') {
            return view('user.dashboard'); // Render the user dashboard view
        }
    }

    // Redirect to the login page if the user is not authenticated or has no role
    return redirect('/login');
});


Route::get('/login', 'App\Http\Controllers\LoginController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\LoginController@login');
Route::post('/logout', 'App\Http\Controllers\LoginController@logout')->name('logout');
Route::get('/register', 'App\Http\Controllers\LoginController@showLoginForm')->name('register');
Route::post('/register', 'App\Http\Controllers\LoginController@register');

Route::group(['middleware' => 'auth'], function () {
    Route::group(['prefix' => 'admin', 'middleware' => 'role:admin'], function () {
        Route::get('/dashboard', 'App\Http\Controllers\AdminController@dashboard')->name('admin.dashboard');

        Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
        Route::post('/categories', [CategoryController::class, 'store'])->name('category.store');
        Route::put('/categories/{category}', [CategoryController::class, 'update'])->name('categories.update');
        Route::get('/categories/{category}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
        Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

        Route::get('/income', [IncomeController::class, 'index'])->name('income.index');
        Route::post('/income', [IncomeController::class, 'store'])->name('income.store');
        Route::put('/income/{income}', [IncomeController::class, 'update'])->name('income.update');
        Route::get('/income/{income}/edit', [IncomeController::class, 'edit'])->name('income.edit');
        Route::delete('/income/{income}', [IncomeController::class, 'destroy'])->name('income.destroy');
        
        Route::get('/expense', [ExpenseController::class, 'index'])->name('expense.index');
        Route::post('/expense', [ExpenseController::class, 'store'])->name('expense.store');
        Route::put('/expense/{expense}', [ExpenseController::class, 'update'])->name('expense.update');
        Route::get('/expense/{expense}/edit', [ExpenseController::class, 'edit'])->name('expense.edit');
        Route::delete('/expense/{expense}', [ExpenseController::class, 'destroy'])->name('expense.destroy');
        


    });

    Route::group(['prefix' => 'user', 'middleware' => 'role:user'], function () {
        Route::get('/dashboard', 'App\Http\Controllers\UserController@dashboard')->name('user.dashboard');
    });
});
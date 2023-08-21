@extends('admin.layouts.master')

@section('main_content')
<form action="" method="post">
    @csrf
    <div class="row">
        <div class="col">
            <label for="from_date">From date: {{ $fromDate->format('Y-m-d') }}</label>
            <input type="date" class="form-control" value="{{ $fromDate }}" id="from_date" name="from_date">
        </div>
        <div class="col">
            <label for="to_date">To date: {{ $toDate->format('Y-m-d') }}</label>
            <input type="date" class="form-control" value="{{ $toDate }}" id="to_date" name="to_date">
        </div>
        <div class="col">
            <label for="category">
                Category : 
                @if (empty($category))
                    All categories
                @else
                    {{ $category }}
                @endif
            </label>
            <select class="form-control" id="category" name="category">
                <option value="">Category</option>
                @foreach ($category_list as $category_list)
                    <option  value="{{ $category_list->name }}" {{ $category == $category_list->name ? 'selected' : '' }}>{{ $category_list->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    
    <button type="submit" class="btn btn-primary mt-3">Search</button>
</form>

<div class="container mt-3">
    <div class="card-deck row">
      <div class="col-xs-12 col-sm-6 col-md-4">
      <div class="card mb-4">
            <div class="card-body">
              <h4 class="card-title">Total Available Balance </h4>
          <p class="card-text"><span style="font-size: 54px" >{{ $availableTotal }} </span> tk </p>
          <p>Cash: {{ $availableTotalcash }} tk</p>
          <p>Bank: {{ $availableTotalbank }} tk</p>
          <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->    
        </div>
    
      </div>
      <!-- Card -->
    </div>
     
      <div class="col-xs-12 col-sm-6 col-md-4">
      <!-- Card -->
      <div class="card mb-4">
    
        <!--Card content-->
        <div class="card-body">
    
          <!--Title-->
          <h4 class="card-title">Total Income</h4>
          <!--Text-->
          <p class="card-text"><span style="font-size: 54px" >{{ $totalIncome }} </span> tk </p>
          <p>Cash: {{ $totalIncomeWithCash }} tk</p>
          <p>Bank: {{ $totalIncomeWithoutCash }} tk</p>
          <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->    
        </div>
    
      </div>
      <!-- Card -->
    </div>
      <div class="col-xs-12 col-sm-6 col-md-4">
      <!-- Card -->
      <div class="card mb-4">
    
        <!--Card content-->
        <div class="card-body">
    
          <!--Title-->
          <h4 class="card-title">Total Expense</h4>
          <!--Text-->
          <p class="card-text"><span style="font-size: 54px" >{{ $totalExpense }} </span> tk </p>
          <p>Cash: {{ $totalexpenseWithCash }} tk</p>
          <p>Bank: {{ $totalexpenseWithoutCash }} tk</p>
          <!-- Provides extra visual weight and identifies the primary action in a set of buttons -->    
        </div>
    
      </div>
      <!-- Card -->
    </div>

    </div>      
    </div>

<br>
<div class="row">
    <div class="col">
        <h3 class=""> Income Data</h3>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Category</th>
                    <th scope="col">Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach($incomessearch as $income)
                <tr>
                    <td>{{ $income->date }}</td>
                    <td>{{ $income->category }}</td>
                    <td>{{ $income->amount }} tk</td>
                
                </tr>
                @endforeach
                <tr>
                    <th>Cash= {{ $totalIncomeWithCash }} tk</th>
                    <th scope="col" >Bank= {{ $totalIncomeWithoutCash }} tk</th>
                    <th scope="col" >Total= {{ $totalIncome }} tk</th>
                </tr>
            </tbody>
        </table>
        <div class="pagination">
            {{ $incomessearch->links('pagination::bootstrap-4') }}
        </div>
            
    </div>
    <div class="col">
        <h3 class=""> Expenses Data</h3>
         <table class="table">
           <thead>
               <tr>
                   <th scope="col">Date</th>
                   <th scope="col">Category</th>
                   <th scope="col">Amount</th>
               </tr>
           </thead>
           <tbody>
               @foreach($Expensesearch as $expense)
               <tr>
                   <td>{{ $expense->date }}</td>
                   <td>{{ $expense->category }}</td>
                   <td>{{ $expense->amount }} tk</td>
               </tr>
               @endforeach
               <tr>
                   <th>Cash= {{ $totalIncomeWithCash }} tk</th>
                   <th scope="col" >Bank= {{ $totalexpenseWithoutCash }} tk</th>
                   <th scope="col" >Total= {{ $totalExpense }} tk</th>
               </tr>
           </tbody>
       </table>
       <div class="pagination">
           {{ $incomessearch->links('pagination::bootstrap-4') }}
       </div>
    </div>
</div>
@endsection

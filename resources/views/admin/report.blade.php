@extends('admin.layouts.master')

@section('main_content')

 <h3 class=""> Income Data</h3>
  <table class="table">
    <thead>
        <tr>
            <th scope="col">Date</th>
            <th scope="col">User ID</th>
            <th scope="col">Category</th>
            <th scope="col">Amount</th>
            <th scope="col">Account</th>
        </tr>
    </thead>
    <tbody>
        @foreach($incomes as $income)
        <tr>
            <td>{{ $income->date }}</td>
            <td>{{ $income->user->name }}</td>
            <td>{{ $income->category }}</td>
            <td>{{ $income->amount }} tk</td>
            <td>{{ $income->account }}</td>     
         
        </tr>
        @endforeach
     
            <th>Total Amount of {{ $incomes->count() }}</th>
            <th>Cash= {{ $totalAmountincome_cash }} tk</th>
            <th scope="col" >Bank= {{ $totalAmountincome_bank }} tk</th>
            <th scope="col" >Total= {{ $totalAmountincome }} tk</th>
          
    
    </tbody>
</table>
<div class="pagination">
    {{ $incomes->links('pagination::bootstrap-4') }}
</div>


<h3 class="mt-3">Expense Data</h3> 
<table class="table">
    <thead>
        <tr>
            <th scope="col">Date</th>
            <th scope="col">User ID</th>
            <th scope="col">Category</th>
            <th scope="col">Amount</th>
            <th scope="col">Account</th>
        </tr>
    </thead>
    <tbody>
        @foreach($expenses as $expense)
        <tr>
            <td>{{ $expense->date }}</td>
            <td>{{ $expense->user->name }}</td>
            <td>{{ $expense->category }}</td>
            <td>{{ $expense->amount }}</td>
            <td>{{ $expense->account }}</td>     
        </tr>
        @endforeach
        <tr>
            <th>Total Amount of {{ $expenses->count() }}</th>
            <th>Cash= {{ $totalAmountexpense_cash }} tk</th>
            <th scope="col" >Bank= {{ $totalAmountexpense_bank }} tk</th>
            <th scope="col" >Total= {{ $totalAmountexpense }} tk</th>
        </tr>
    </tbody>
</table>
<div class="pagination">
    {{ $expenses->links('pagination::bootstrap-4') }}
</div>
@endsection



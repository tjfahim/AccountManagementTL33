@extends('admin.layouts.master')

@section('main_content')

<div class="container">

    <!-- Card deck -->
    <div class="card-deck row">
    

      <div class="col-xs-12 col-sm-6 col-md-4">
      <!-- Card -->
      <div class="card mb-4">
    
        <!--Card content-->
        <div class="card-body">
    
          <!--Title-->
          <h4 class="card-title">Total Available Balance This Month</h4>
          <!--Text-->
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
          <h4 class="card-title">Total Income This Month</h4>
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
          <h4 class="card-title">Total Expense This Month</h4>
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
    <!-- Card deck -->
      
    </div>
  
@endsection



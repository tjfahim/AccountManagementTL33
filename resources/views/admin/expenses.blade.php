@extends('admin.layouts.master')


@section('main_content')

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#expenseModal">
        Add Expense
    </button>
    
  <!-- Modal -->
  <div class="modal fade" id="expenseModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Expense</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{ route('expense.store') }}">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select id="category" name="category" class="form-control" required>
                                <option value="">Select Category</option>
                                @foreach ($activeCategories as $category)
                                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label for="account">Account</label>
                            <select id="account" name="account" class="form-control" required>
                                <option value="">Select Account</option>
                                <option value="Cash" selected>Cash</option>
                                <option value="Bkas">Bkas</option>
                                <option value="Roket">Roket</option>
                                <option value="Nagad">Nagad</option>
                                <option value="Islami Bank">Islami Bank</option>
                                <option value="Dhaka Bank">Dhaka Bank</option>
                                <option value="Dutch Bangla Bank">Dutch Bangla Bank</option>
                                <option value="Sonali Bank">Sonali Bank</option>
                                <option value="Other Bank">Other Bank</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="date" class="form-control" id="date" name="date" value="{{ date('Y-m-d') }}" required>
                </div>                
                
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" step="0.01" class="form-control" id="amount" name="amount" placeholder="Enter Amount" required>
                </div>
             
                <div class="form-group">
                    <label for="details">Details</label>
                    <input type="text" class="form-control" id="details" name="detail" placeholder="Enter Details" >
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            
        </div>
      </div>
    </div>
  </div>
 

  <table class="table">
    <thead>
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Date</th>
            <th scope="col">User ID</th>
            <th scope="col">Category</th>
            <th scope="col">Amount</th>
            <th scope="col">Account</th>
            <th scope="col">Detail</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($expenses as $expense)
        <tr>
            <th scope="row">{{ $expense->id }}</th>
            <td>{{ $expense->date }}</td>
            <td>{{ $expense->user->name }}</td>
            <td>{{ $expense->category }}</td>
            <td>{{ $expense->amount }}</td>
            <td>{{ $expense->account }}</td>     
            <td>{{ $expense->detail }}</td>
            <td>
                <a href="{{ route('expense.edit', ['expense' => $expense->id]) }}" class="btn btn-primary btn-sm" style="display: inline-block;">Edit</a>

                <!-- Delete button -->
                <form action="{{ route('expense.delete', ['expense' => $expense->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this expense?')" style="display: inline-block;">
                    @csrf
                    @method('post')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
        <tr>
            <th scope="col" colspan="4">Total Amount for page {{ $expenses->currentPage() }}</th>
            <td colspan="4">{{ $totalAmount }} tk</td>
        </tr>
    </tbody>
</table>
<div class="pagination">
    {{ $expenses->links('pagination::bootstrap-4') }}
</div>
@endsection



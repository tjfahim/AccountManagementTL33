@extends('admin.layouts.master')


@section('main_content')

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#incomeModal">
        Add Income
    </button>
    
  <!-- Modal -->
  <div class="modal fade" id="incomeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Income</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{ route('income.store') }}">
                @csrf
                @method('POST')
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="category">Category</label>
                            <select id="category" name="category" class="form-control" required>
                                <option value="">Select Category</option>
                                @foreach ($activeCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
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
        @foreach($incomes as $income)
        <tr>
            <th scope="row">{{ $income->id }}</th>
            <td>{{ $income->date }}</td>
            <td>{{ $income->user_id }}</td>
            <td>{{ $income->category }}</td>
            <td>{{ $income->amount }}</td>
            <td>{{ $income->account }}</td>     
            <td>{{ $income->detail }}</td>
            <td>
                <a href="{{ route('income.edit', ['income' => $income->id]) }}" class="btn btn-primary btn-sm" style="display: inline-block;">Edit</a>

                <!-- Delete button -->
                <form action="{{ route('income.destroy', ['income' => $income->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this income?')" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="pagination">
    {{ $incomes->links('pagination::bootstrap-4') }}
</div>
@endsection



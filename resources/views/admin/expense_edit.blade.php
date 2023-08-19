@extends('admin.layouts.master')


@section('main_content')

    <h2 class="text-center mb-4">Expense Edit</h2>

    <div class="modal-body mt-4">
        <form method="post" action="{{ route('expense.update', ['expense' => $expense->id]) }}">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col">
                        <label for="category">Category</label>
                        <select id="category" name="category" class="" required>
                            <option value="">Select Category</option>
                            @foreach ($activeCategories as $category)
                                <option value="{{ $category->name }}" {{ $category->id == $expense->category ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                </div>
                
                <div class="col">
                        <label for="account">Account</label>
                        <select id="account" name="account" class="" required>
                            <option value="">Select Account</option>
                            <option value="Cash" {{ $expense->account === 'Cash' ? 'selected' : '' }}>Cash</option>
                            <option value="Bkas" {{ $expense->account === 'Bkas' ? 'selected' : '' }}>Bkas</option>
                            <option value="Roket" {{ $expense->account === 'Roket' ? 'selected' : '' }}>Roket</option>
                            <option value="Nagad" {{ $expense->account === 'Nagad' ? 'selected' : '' }}>Nagad</option>
                            <option value="Islami Bank" {{ $expense->account === 'Islami Bank' ? 'selected' : '' }}>Islami Bank</option>
                            <option value="Dhaka Bank" {{ $expense->account === 'Dhaka Bank' ? 'selected' : '' }}>Dhaka Bank</option>
                            <option value="Dutch Bangla Bank" {{ $expense->account === 'Dutch Bangla Bank' ? 'selected' : '' }}>Dutch Bangla Bank</option>
                            <option value="Sonali Bank" {{ $expense->account === 'Sonali Bank' ? 'selected' : '' }}>Sonali Bank</option>
                            <option value="Other Bank" {{ $expense->account === 'Other Bank' ? 'selected' : '' }}>Other Bank</option>
                        </select>
                </div>
            </div>
            
            <div class="form-group">
                <label for="date">Date</label>
                <input type="date" class="form-control" id="date" name="date" value="{{ $expense->date ?? date('Y-m-d') }}" required>
            </div>              
            
            <div class="form-group">
                <label for="amount">Amount</label>
                <input type="number" step="0.01" class="form-control"  value="{{ $expense->amount }}" id="amount" name="amount" placeholder="Enter Amount" required>
            </div>
         
            <div class="form-group">
                <label for="details">Details</label>
                <input type="text" class="form-control" id="details"  value="{{ $expense->detail }}" name="detail" placeholder="Enter Details" >
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
        
    </div>



@endsection



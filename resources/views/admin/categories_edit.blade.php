@extends('admin.layouts.master')


@section('main_content')

    <h2 class="text-center">Category Edit</h2>

    <div class="modal-body">
        <form method="post" action="{{ route('categories.update', ['category' => $category->id]) }}">
            @method('PUT')
            @csrf 
            <div class="form-group">
                <label for="category">Name</label>
                <input type="text" class="form-control" id="category" value="{{ $category->name }}" name="name" placeholder="Enter Category Name">
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <input type="text" class="form-control" id="description" value="{{ $category->description }}" name="description" placeholder="Enter Description">
            </div>
            
            <button type="submit" class="btn btn-primary mt-3">Save</button>
            </form>
    </div>



@endsection



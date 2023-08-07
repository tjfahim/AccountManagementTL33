@extends('admin.layouts.master')


@section('main_content')

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#catmodal">
        Add Category
    </button>
    
  <!-- Modal -->
  <div class="modal fade" id="catmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Category</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="post" action="{{ route('category.store')}}">
                @csrf 
                <div class="form-group">
                  <label for="category">Name</label>
                  <input type="text" class="form-control" id="category" name="name" placeholder="Enter Category Name">
                </div>
                <div class="form-group">
                  <label for="description">Description</label>
                  <input type="text" class="form-control" id="description" name="description" placeholder="Enter Description">
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
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
        <tr>
            <th scope="row">{{ $category->id }}</th>
            <td>{{ $category->name }}</td>
            <td>{{ $category->description }}</td>
            <td>
                
                <a href="{{ route('categories.edit', ['category' => $category->id]) }}" class="btn btn-primary btn-sm" style="display: inline-block;">Edit</a>
            
      
                <!-- Delete button -->
                <form action="{{ route('categories.destroy', ['category' => $category->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this category?')" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>             
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection



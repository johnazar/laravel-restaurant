@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (Session::has('message'))
            <div class="alert alert-secondary">{{Session::get('message')}}</div>
            @endif
            <div class="card">
                <div class="card-header">Add Food</div>

                <div class="card-body">
                   <form action="{{route('food.store')}}" method="post" enctype="multipart/form-data">
                       @csrf
                       <div class="form-group">
                           <label for="name">Name</label>
                           <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                           @error('name')
                           <span class="invalid-feedback" role="alert">
                               <strong>{{ $message }}</strong>
                           </span>
                       @enderror
                       </div>
                       <div class="form-group">
                         <label for="description">Description</label>
                         <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="2"></textarea>
                         @error('description')
                         <span class="invalid-feedback" role="alert">
                             <strong>{{ $message }}</strong>
                         </span>
                        @enderror
                       </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror">
                            @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                          <label for="category_id">Category</label>
                          <select class="form-control @error('price') is-invalid @enderror" name="category_id">
                            <option value="">Select Category</option>
                              @foreach (App\Category::all() as $cat)
                              <option value="{{$cat->id}}">{{$cat->name}}</option>
                              @endforeach
                          </select>
                            @error('category_id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror">
                            @error('image')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                        <input type="submit" class="btn btn-primary"value="Submit">
                        
                   </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

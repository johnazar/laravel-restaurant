@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">All Categories<a href="{{route('category.create')}}"class="float-right btn btn-secondary">Add category</a></div>
                @if (Session::has('message'))
                    <div class="alert alert-secondary">{{Session::get('message')}}</div>
                @endif
                <div class="card-body">
                    <table class="table">
                        <thead class="thead-dark">
                          <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col" colspan="2">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $key=>$category)
                                <tr>
                                    <th scope="row">{{$key+1}}</th>
                                    <td>{{$category->name}}</td>
                                    <td>
                                        <a href="{{route('category.edit',[$category->id])}}" class="btn btn-outline-success">Edit</a>
                                        {{-- <button type="submit" class="btn btn-outline-danger">Delete</button> --}}
                                        <!-- Button trigger modal -->
                                        <button type="button" class="btn btn-outline-danger" data-toggle="modal" data-target="#DeleteModal{{$category->id}}">
                                            Delete
                                        </button>
                                        
                                        <!-- Modal -->
                                        <div class="modal fade" id="DeleteModal{{$category->id}}" tabindex="-1" role="dialog" aria-labelledby="DeleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="DeleteModalLabel">Delete Category</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure to delete this item?
                                                    <form action="{{route('category.destroy',[$category->id])}}" method="post" style="display:inline">
                                                        @method('DELETE')
                                                        @csrf
                                                </div>
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-outline-danger">Delete</button>
                                            </form>
                                                </div>
                                            </div>
                                            </div>
                                        </div>
                                        
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No categories found</td>
                                </tr>
                            @endforelse
                            
                        </tbody>
                      </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

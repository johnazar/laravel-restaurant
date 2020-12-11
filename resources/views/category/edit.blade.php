@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Manage Food Category</div>
                @if (Session::has('message'))
                    <div class="alert alert-secondary">{{Session::get('message')}}</div>
                @endif
                <div class="card-body">
                    <form action="{{route('category.update',[$category->id])}}" method="post">
                        {{method_field('PUT')}}
                        @csrf
                        <div class="form-group">
                            <label for="name">Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$category->name}}">
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-outline-primary">Update</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection

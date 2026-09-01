@extends('Admin.layout.master')
@section('main')
<div class="row w-100 justify-content-center align-items-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-head">
                <h1 class="card-header">Create Sub Category</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.subcategory.store') }}" class="d-flex flex-column gap-3" method="POST">
                    @csrf
                    <select name="category_id" class="form-control">
                        <option value="">Select Category</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <input type="text" name="name" placeholder="Enter Sub Category Name" class="form-control">
                    @error('name')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <button class="btn btn-primary" type="submit">Create Sub Category</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
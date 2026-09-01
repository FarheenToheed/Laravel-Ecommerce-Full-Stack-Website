@extends('Admin.layout.master')
@section('main')
<div class="row w-100 justify-content-center align-items-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-head">
                <h1 class="card-header">Edit Category {{ $category->id }}</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.category.update', $category->id) }}" class="d-flex flex-column gap-3" method="post">
                    @method('PUT')
                    @csrf
                    <input type="hidden" name="category_id" value="{{ $category->id }}">
                    <input type="text" name="name" value="{{ $category->name }}" placeholder="enter name" class="form-control">
                    @error('name')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <button class="btn btn-primary" type="submit">Update Category</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection     
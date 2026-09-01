@extends('Admin.layout.master')
@section('main')
<div class="row w-100 justify-content-center align-items-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-head">
                <h1 class="card-header">
                    Edit Sub Category {{ $subCategory->id }}
                </h1>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.subcategory.update', $subCategory->id) }}"
                      method="POST"
                      class="d-flex flex-column gap-3">
                    @method('PUT')
                    @csrf
                    {{-- Category Dropdown --}}
                    <select name="category_id" class="form-control">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ $subCategory->category_id == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    {{-- Sub Category Name --}}
                    <input type="text" name="name" value="{{ $subCategory->name }}" class="form-control"  laceholder="Enter Sub Category Name">
                    @error('name')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <button class="btn btn-primary" type="submit">Update Sub Category</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
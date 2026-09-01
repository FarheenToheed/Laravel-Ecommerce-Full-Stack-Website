@extends('Admin.layout.master')
@section('main')
<div class="row w-100 justify-content-center align-items-center">
    <div class="col-md-10">
        <div class="card">
            <div class="card-head">
                <h1 class="card-header">Create Category</h1>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.category.store') }}" class="d-flex flex-column gap-3" method="post">
                    @csrf
                    <input type="text" name="name" placeholder="enter name" class="form-control">
                    @error('name')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                    <button class="btn btn-primary" type="submit">Create Category</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
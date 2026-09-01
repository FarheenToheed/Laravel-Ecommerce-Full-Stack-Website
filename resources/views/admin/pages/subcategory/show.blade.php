@extends('Admin.layout.master')

@section('main')
<div class="row w-100 justify-content-center align-items-center">
    <div class="col-md-8">

        <div class="card">

            <div class="card-header d-flex justify-content-between align-items-center">
                <h4>Category Detail</h4>

                <a href="{{ route('admin.subcategory.index') }}" class="btn btn-secondary btn-sm">
                    Back
                </a>
            </div>

            <div class="card-body">

                <table class="table table-bordered">

                    <tr>
                        <th>ID</th>
                        <td>{{ $subcategory->id }}</td>
                    </tr>

                    <tr>
                        <th>Category Name</th>
                        <td>{{ $category->name }}</td>
                    </tr>
                    <tr>
                        <th>Sub Category Name</th>
                        <td>{{ $subcategory->name }}</td>
                    </tr>

                    
                    <tr>
                        <th>Created At</th>
                        <td>{{ $subcategory->created_at }}</td>
                    </tr>

                    <tr>
                        <th>Updated At</th>
                        <td>{{ $subcategory->updated_at }}</td>
                    </tr>

                </table>

            </div>

        </div>

    </div>
</div>
@endsection
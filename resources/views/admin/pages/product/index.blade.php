@extends('admin.layout.master')

@section('main')

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    {{-- HEADER --}}
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Product</h5>

                        <a href="{{ route('admin.product.create') }}" class="btn btn-primary">
                            + Create Products
                        </a>
                    </div>

                    <div class="card-body">

                        {{-- SUCCESS MESSAGE (FIXED) --}}
                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- ERROR MESSAGE --}}
                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        {{-- TABLE --}}
                        <div class="table-responsive overflow-auto">
                            <table class="table table-bordered table-hover table-sm align-middle w-100">


                        {{-- <div class="table-responsive">
                            <table class="table table-bordered align-middle"> --}}
                                <thead> 
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            SKU
                                        </th>
                                        
                                         <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Stock</th>
                                         <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>   
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Created at</th> 

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="200">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($product as $pro)
                                        <tr>
                                            <td>{{ $pro->id }}</td>
                                            <td>{{ $pro->name }}</td>
                                            <td>{{ $pro->sku }}</td>
                                            <td>{{ $pro->stock }}</td>
                                            <td>{{ $pro->status }}</td>
                                            {{-- <td>{{ $pro->status ? 'true' : 'false' }}</td> --}}
                                            <td>{{ $pro->created_at->diffForHumans() }}</td>
                                            <td class="d-flex gap-2">
                                                
                                                <a href="{{ route('admin.product.show', $pro->id) }}" class="btn btn-warning btn-xs">
                                                <i class="fa fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.product.edit', $pro->id) }}" class="btn btn-warning btn-xs">
                                                <i class="fa fa-pencil"></i>
                                                </a>
                                                <form action="{{ route('admin.product.destroy', $pro->id) }}" method="POST"
                                                    onsubmit="return confirm('Are you sure?')">

                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-xs btn-danger" type="submit">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="4" class="text-center text-muted">No Products found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

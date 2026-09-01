@extends('admin.layout.master')

@section('main')

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    {{-- HEADER --}}
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Product Varient</h5>

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#createproductvariantModal">
                            + Create Product Varient
                        </button>
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
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Price
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Product
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Size
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Color</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="200">Created At</th>    

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="200">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($product_variants as $pro)
                                        <tr>
                                            <td>{{ $pro->id }}</td>
                                            <td>{{ $pro->price }}</td>
                                            <td>{{ $pro->product->id }}|{{ $pro->product->name }}</td>
                                            <td>{{ $pro->product_size?->id }}|{{ $pro->product_size?->name }}</td>
                                            <td>{{ $pro->product_color?->id }}|{{ $pro->product_color?->name }}</td>
                                            {{-- <td>{{ $cat->categories->count() }}</td> --}}
                                            <td>{{ $pro->created_at->diffForHumans() }}</td>
                                            <td class="d-flex gap-2">
                                                

                                                <button class="btn btn-xs btn-warning editBtn"
                                                    data-id="{{ $pro->id }}" data-name="{{ $pro->price }}"
                                                    data-product="{{ $pro->product->id }}"
                                                    data-size="{{ $pro->product_size?->id}}"
                                                    data-color="{{ $pro->product_color?->id  }}" data-bs-toggle="modal"
                                                    data-bs-target="#editproductvariantModal">
                                                    <i class="fa fa-pencil"></i>
                                                </button> 


                                                <form action="{{ route('admin.productvariant.destroy', $pro->id) }}" method="POST"
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
                                            <td colspan="4" class="text-center text-muted">No Products Variants found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Create Modal -->
        <div class="modal fade" id="createproductvariantModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Product Varients</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.productvariant.store') }}" id="createproductvarientForm"
                            class="d-flex flex-column gap-3" method="POST">
                            @csrf
                            
                            {{-- select Product --}}
                            <select name="product_id" class="form-control form-select">
                                <option value="">Select Product</option>
                                @foreach ($product as $prod)
                                    <option value="{{ $prod->id }}">{{ $prod->name }}</option>
                                @endforeach
                            </select>
                            @error('product_id')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            {{-- Size   --}}
                            <select name="size_id" class="form-control form-select">
                                <option value="">Select Size</option>
                                @foreach ($product_size as $sz)
                                    <option value="{{ $sz->id }}">{{ $sz->name }}</option>
                                @endforeach
                            </select>
                            @error('size_id')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            {{-- Color --}}
                            <select name="color_id" class="form-control form-select">
                                <option value="">Select Color</option>
                                @foreach ($product_color as $cl)
                                    <option value="{{ $cl->id }}">{{ $cl->name }}</option>
                                @endforeach
                            </select>
                            @error('color_id')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                            <div class="form-group mb-1">
                                <h6 class=" text-xs mb-0">Enter Product Price</h6>
                                <input type="number" name="price" placeholder="Enter Product Price" class="form-control">
                                @error('price')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" form="createproductvarientForm" class="btn btn-primary">Save Product Varient</button>
                    </div>
                </div>
            </div>
        </div> 
        {{-- End Modals  --}}

        {{-- Edit Modal --}}
        <div class="modal fade" id="editproductvariantModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Product Varients</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editproductvariantForm" class="d-flex flex-column gap-3" method="post">
                            @csrf
                            @method('PUT')
                           {{-- Child Category Dropdown --}}
                           <div class="form-group mb-1">
                                <h6 class=" text-xs mb-0">Product Name</h6>
                                <select name="product_id" class="form-control" id="edit_product_id">
                                    @foreach($product as $pro)
                                    <option value="{{ $pro->id }}">
                                        {{ $pro->name }}
                                    </option>
                                    @endforeach                                
                                </select>
                                @error('product_id')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                                {{-- Child Category Dropdown --}}
                            <div class="form-group mb-1">
                                <h6 class=" text-xs mb-0">Product Size</h6>
                                <select name="size_id" class="form-control" id="edit_size_id">
                                    @foreach($product_size as $pro)
                                    <option value="{{ $pro->id }}">
                                        {{ $pro->name }}
                                    </option>
                                    @endforeach                                
                                </select>
                                @error('size_id')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>    
                                {{-- Child Category Dropdown --}}
                            <div class="form-group mb-1">
                                <h6 class=" text-xs mb-0">Product Color</h6>
                                <select name="color_id" class="form-control" id="edit_color_id">
                                    @foreach($product_color as $pro)
                                    <option value="{{ $pro->id }}">
                                        {{ $pro->name }}
                                    </option>
                                    @endforeach                                
                                </select>
                                @error('color_id')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>   
                                {{-- Sub Category Name --}}
                            <div class="form-group mb-1">
                                <h6 class=" text-xs mb-0">Product Price</h6>
                                <input type="number" name="price" id="edit_price" value="{{ $pro->price }}" class="form-control">
                                @error('price')
                                    <div class="alert alert-danger">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" form="editproductvariantForm" class="btn btn-primary">Update Category</button>
                    </div>
                </div>
            </div>
        </div>  
        {{-- End Edit Modal --}}
    </div>
@endsection

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const baseUrl = "{{ url('/admin/productvariant') }}";

    const editButtons = document.querySelectorAll('.editBtn');
    const editForm = document.getElementById('editproductvariantForm');
    const editPrice = document.getElementById('edit_price');
    const editProductId = document.getElementById('edit_product_id');
    const editSizeId = document.getElementById('edit_size_id');
    const editColorId = document.getElementById('edit_color_id');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {

            const id       = this.getAttribute('data-id');
            const price    = this.getAttribute('data-name');      // data-name mai price store hai
            const product  = this.getAttribute('data-product');
            const size     = this.getAttribute('data-size');
            const color    = this.getAttribute('data-color');

            // Modal fields fill karo
            editPrice.value          = price;
            editProductId.value      = product;
            editSizeId.value         = size;
            editColorId.value        = color;

            // Form action dynamically set karo
            editForm.action = `${baseUrl}/${id}`;
        });
    });

});
</script>
@endpush
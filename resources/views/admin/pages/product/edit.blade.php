@extends('admin.layout.master')

@section('main')

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    {{-- HEADER --}}
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Product</h5>

                        {{-- <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#createchildCategoryModal">
                            + Create Products
                        </button> --}}
                    </div>

                    <div class="card-body">

                        <form action="{{ route('admin.product.update', $product->id) }}" method="POST"
                            class="d-flex flex-column gap-3"  enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            {{-- Name --}}
                            <label for="name">Enter Product Name
                                <input type="text" name="name" class="form-control text-xs" value="{{ $product->name }}"
                                    placeholder="Enter Product Name">
                            </label>

                            {{-- Details --}}
                            <label for="details">Enter Product Details
                                <textarea name="details" class="form-control text-xs"
                                    placeholder="Enter Product Details">{{ $product->details }}</textarea>
                            </label>
                            <label for="description">Enter Product Description
                                <textarea name="description" class="form-control text-xs"
                                    placeholder="Enter Product Description">{{ $product->description }}</textarea>
                            </label>


                            {{-- Size Guide --}}
                            <label for="size_guide">Enter Product Sizes
                                <input type="text" name="size_guide" class="form-control text-xs"
                                    value="{{ $product->size_guide }}" placeholder="Enter Size Guide">
                            </label>


                            <div class="row">
                                {{-- Stock --}}

                                <div class="col-md-6">
                                    <label for="stock">Enter Product Stock</label>
                                    <input type="number" name="stock" class="form-control text-xs"
                                        value="{{ $product->stock }}" placeholder="Enter Stock">

                                </div>

                                {{-- Sub Category --}}
                                <div class="col-md-6">
                                    <label for="sub_category">Select Sub Categories</label>
                                    <select name="sub_category_id" class="form-select text-xs">
                                        @foreach($sub_categories as $sub)
                                            <option value="{{ $sub->id }}" {{ $product->sub_category_id == $sub->id ? 'selected' : '' }}>
                                                {{ $sub->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>

                                {{-- Child Category --}}
                                <div class="col-md-6">
                                    <label for="child_category">Select Child Categories</label>
                                    <select name="child_category_id" class="form-select text-xs">
                                        @foreach($child_categories as $child)
                                            <option value="{{ $child->id }}" {{ $product->child_category_id == $child->id ? 'selected' : '' }}>
                                                {{ $child->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Status --}}
                                <div class="col-md-6">
                                    <label for="status">Select Status</label>
                                    <select name="status" class="form-select text-xs" id="status">
                                        <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active
                                        </option>
                                        <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>
                                            Inactive</option>
                                    </select>
                                </div>
                            </div>
                            {{-- images --}}
                            <label>Product Images</label>

                            <input type="file" id="imageInput" name="images[]" class="form-control" multiple>
                            <input type="hidden" name="delete_images" id="deleteImages" value="[]">
                            <div id="existingImages" class="d-flex flex-wrap gap-2">

    @foreach($product->product_images as $image)

        <div class="position-relative old-img-box">

            <img src="{{ asset('storage/'.$image->image_path) }}"
                 width="100"
                 height="100"
                 style="object-fit:cover;border-radius:6px;">

            <button type="button"
                onclick="removeOldImg(this, {{ $image->id }})"
                style="position:absolute;top:-5px;right:-5px;
                background:red;color:#fff;border:none;border-radius:50%;
                width:20px;height:20px;font-size:12px;">
                ×
            </button>

        </div>

    @endforeach

</div>

                            {{-- Preview Area --}}
                            <div id="previewContainer" class="d-flex flex-wrap gap-2 mt-2"></div>

                            <button type="submit" class="btn btn-success">
                                Update Product
                            </button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
<script>
function removeOldImg(btn, id)
{
    btn.parentElement.remove();

    let input = document.getElementById('deleteImages');

    let current = input.value ? JSON.parse(input.value) : [];

    current.push(id);

    input.value = JSON.stringify(current);
}
</script>
@endpush
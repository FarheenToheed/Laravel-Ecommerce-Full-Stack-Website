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

    {{-- Category --}}
    <div class="col-md-6">
        <label for="category">Select Category</label>
        <select class="form-select text-xs" id="category_select" required>
            <option value="">Select Category</option>
            @foreach ($categories as $cat)
                <option value="{{ $cat->id }}"
                    {{ optional($product->sub_category->category)->id == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- Sub Category --}}
    <div class="col-md-6">
        <label for="sub_category">Select Sub Category</label>
        <select class="form-select text-xs" name="sub_category_id" id="sub_category_select" required>
            <option value="">Select Sub Category</option>
        </select>
        @error('sub_category_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    {{-- Child Category --}}
    <div class="col-md-6">
        <label for="child_category">Select Child Category</label>
        <select class="form-select text-xs" name="child_category_id" id="child_category_select" required>
            <option value="">Select Child Category</option>
        </select>
        @error('child_category_id')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    {{-- Stock --}}
    <div class="col-md-6">
        <label for="stock">Enter Stock Quantity</label>
        <input type="number" name="stock" class="form-control text-xs"
            value="{{ old('stock', $product->stock) }}">
        @error('stock')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
    </div>

    {{-- Status --}}
    <div class="col-md-6">
        <label for="status">Select Status</label>
        <select class="form-select text-xs" name="status" id="status">
            <option value="">Select Status</option>
            <option value="active" {{ $product->status == 'active' ? 'selected' : '' }}>Active</option>
            <option value="inactive" {{ $product->status == 'inactive' ? 'selected' : '' }}>Inactive</option>
        </select>
        @error('status')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
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
    const categoriesData = @json($categories);

    // Product ki abhi ki saved values (edit ke liye zaroori)
    const currentSubCategoryId = {{ $product->sub_category_id ?? 'null' }};
    const currentChildCategoryId = {{ $product->child_category_id ?? 'null' }};

    const categorySelect = document.getElementById('category_select');
    const subCategorySelect = document.getElementById('sub_category_select');
    const childCategorySelect = document.getElementById('child_category_select');

    function loadSubCategories(categoryId, preselectSubId = null) {

        subCategorySelect.innerHTML = '<option value="">Select Sub Category</option>';
        childCategorySelect.innerHTML = '<option value="">Select Child Category</option>';

        if (!categoryId) return;

        const category = categoriesData.find(cat => cat.id == categoryId);

        if (category && category.sub_categories.length) {
            category.sub_categories.forEach(sub => {
                const selected = (sub.id == preselectSubId) ? 'selected' : '';
                subCategorySelect.innerHTML += `<option value="${sub.id}" ${selected}>${sub.name}</option>`;
            });
        }
    }

    function loadChildCategories(categoryId, subCategoryId, preselectChildId = null) {

        childCategorySelect.innerHTML = '<option value="">Select Child Category</option>';

        if (!subCategoryId) return;

        const category = categoriesData.find(cat => cat.id == categoryId);
        if (!category) return;

        const subCategory = category.sub_categories.find(sub => sub.id == subCategoryId);

        if (subCategory && subCategory.child_categories.length) {
            subCategory.child_categories.forEach(child => {
                const selected = (child.id == preselectChildId) ? 'selected' : '';
                childCategorySelect.innerHTML += `<option value="${child.id}" ${selected}>${child.name}</option>`;
            });
        }
    }

    // Page load hote hi purani saved values ke hisaab se dropdowns bhar dein
    window.addEventListener('DOMContentLoaded', function () {

        const initialCategoryId = categorySelect.value;

        if (initialCategoryId) {
            loadSubCategories(initialCategoryId, currentSubCategoryId);
            loadChildCategories(initialCategoryId, currentSubCategoryId, currentChildCategoryId);
        }
    });

    // Jab user khud Category badle
    categorySelect.addEventListener('change', function () {
        loadSubCategories(this.value);
    });

    // Jab user khud Sub Category badle
    subCategorySelect.addEventListener('change', function () {
        loadChildCategories(categorySelect.value, this.value);
    });
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
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

                        <form action="{{ route('admin.product.store') }}" enctype="multipart/form-data"
                            class="d-flex flex-column gap-3" method="post">
                            @csrf
                            {{-- value="{{ old('name', $product->name) }}" for edit form checking --}}
                            {{-- is mai phale us input field ka name hoga or dosra null string h jha pr uski default value
                            jati h lakin current time mia ue null chorna h kyo k hm koi default value show hi ni krva rahe
                            --}}
                            {{-- Product Name --}}
                            <label for="name">Enter Product Name
                                <input type="text" name="name" placeholder="Enter Product Name" class="form-control text-xs"
                                    value="{{ old('name', '') }}">

                                @error('name')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </label>
                            {{-- SKU --}}
                            {{-- <input type="text" name="sku" placeholder="Enter SKU" class="form-control">
                            @error('sku')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror --}}

                            {{-- Details --}}
                            <label for="detail">Enter Products Details
                                <textarea class="form-control text-xs" name="details"
                                    placeholder="Enter Product Details">{{ old('details', '') }}</textarea>

                                @error('details')
                                    <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </label>

                            {{-- Description --}}
                            <label for="description">Enter Products Description
                                <textarea class="form-control text-xs" name="description"
                                    placeholder="Enter Product Description">{{ old('description', '') }}</textarea>
                            </label>
                            @error('description')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            {{-- Size Guide --}}
                            <label for="size_guide">Enter Size Guide
                                <textarea class="form-control text-xs" name="size_guide"
                                    placeholder="Enter Size Guide">{{ old('size_guide', '') }}</textarea>
                            </label>
                            @error('size_guide')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            {{-- Stock --}}
                            {{-- Category, Sub Category, Child Category, Status --}}
                            <div class="row">

                                {{-- Category --}}
                                <div class="col-md-6">
                                    <label for="category">Select Category</label>
                                    <select class="form-select text-xs" id="category_select" required>
                                        <option value="">Select Category</option>
                                        @foreach ($categories as $cat)
                                            <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Sub Category --}}
                                <div class="col-md-6">
                                    <label for="sub_category">Select Sub Category</label>
                                    <select class="form-select text-xs" name="sub_category_id" id="sub_category_select"
                                        required disabled>
                                        <option value="">Select Sub Category</option>
                                    </select>
                                    @error('sub_category_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Child Category --}}
                                <div class="col-md-6">
                                    <label for="child_category">Select Child Category</label>
                                    <select class="form-select text-xs" name="child_category_id" id="child_category_select"
                                        required disabled>
                                        <option value="">Select Child Category</option>
                                    </select>
                                    @error('child_category_id')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Stock --}}
                                <div class="col-md-6">
                                    <label for="stock">Enter Stock Quantity</label>
                                    <input type="number" name="stock" placeholder="Enter Stock Quantity"
                                        class="form-control text-xs" value="{{ old('stock', '') }}">
                                    @error('stock')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                {{-- Status --}}
                                <div class="col-md-6">
                                    <label for="status">Select Status</label>
                                    <select class="form-select text-xs" name="status" id="status">
                                        <option value="">Select Status</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">Inactive</option>
                                    </select>
                                    @error('status')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>

                            <label>
                                Product Images
                                <input type="file" id="imageInput" name="images[]" class="form-control" multiple>
                            </label>

                            {{-- Preview Area --}}
                            <div id="previewContainer" class="d-flex flex-wrap gap-2 mt-2"></div>

                            @error('images')
                                <div class="alert alert-danger">{{ $message }}</div>
                            @enderror

                            <button class="btn btn-primary text-xs" type="submit">
                                Create Product
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
        // PHP se saara categories > sub_categories > child_categories data JS mein bhej rahe hain
        const categoriesData = @json($categories);

        const categorySelect = document.getElementById('category_select');
        const subCategorySelect = document.getElementById('sub_category_select');
        const childCategorySelect = document.getElementById('child_category_select');

        categorySelect.addEventListener('change', function () {

            const categoryId = this.value;

            // Reset dono dropdowns
            subCategorySelect.innerHTML = '<option value="">Select Sub Category</option>';
            childCategorySelect.innerHTML = '<option value="">Select Child Category</option>';
            childCategorySelect.disabled = true;

            if (!categoryId) {
                subCategorySelect.disabled = true;
                return;
            }

            const category = categoriesData.find(cat => cat.id == categoryId);

            if (category && category.sub_categories.length) {
                category.sub_categories.forEach(sub => {
                    subCategorySelect.innerHTML += `<option value="${sub.id}">${sub.name}</option>`;
                });
                subCategorySelect.disabled = false;
            }
        });


        subCategorySelect.addEventListener('change', function () {

            const subCategoryId = this.value;

            childCategorySelect.innerHTML = '<option value="">Select Child Category</option>';

            if (!subCategoryId) {
                childCategorySelect.disabled = true;
                return;
            }

            const categoryId = categorySelect.value;
            const category = categoriesData.find(cat => cat.id == categoryId);
            const subCategory = category.sub_categories.find(sub => sub.id == subCategoryId);

            if (subCategory && subCategory.child_categories.length) {
                subCategory.child_categories.forEach(child => {
                    childCategorySelect.innerHTML += `<option value="${child.id}">${child.name}</option>`;
                });
                childCategorySelect.disabled = false;
            }
        });

        let input = document.getElementById('imageInput');
        let preview = document.getElementById('previewContainer');

        let filesArray = [];

        input.addEventListener('change', function () {

            // add new files to existing array
            filesArray = filesArray.concat(Array.from(this.files));

            updateInput();
            render();
        });

        function render() {
            preview.innerHTML = "";

            filesArray.forEach((file, i) => {

                let reader = new FileReader();

                reader.onload = function (e) {
                    preview.innerHTML += `
                        <div style="position:relative;">
                            <img src="${e.target.result}" width="100" height="100"
                                style="object-fit:cover;border-radius:6px;">

                            <button type="button"
                                onclick="removeImg(${i})"
                                style="position:absolute;top:-5px;right:-5px;
                                background:red;color:#fff;border:none;border-radius:50%;">
                                ×
                            </button>
                        </div>
                    `;
                };

                reader.readAsDataURL(file);
            });
        }

        function removeImg(index) {
            filesArray.splice(index, 1);
            updateInput();
            render();
        }

        function updateInput() {
            let dt = new DataTransfer();

            filesArray.forEach(file => dt.items.add(file));

            input.files = dt.files;
        }
    </script>

@endpush
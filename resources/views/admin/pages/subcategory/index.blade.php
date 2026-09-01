@extends('admin.layout.master')

@section('main')

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    {{-- HEADER --}}
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Sub Category</h5>

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#createsubCategoryModal">
                            + Create SubCategory
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Category
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            ChildCategories
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Created At</th>

                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                            width="200">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($sub_categories as $cat)
                                    {{-- {{ dd($cat) }} --}}
                                        <tr>
                                            <td>{{ $cat->id }}</td>
                                            <td>{{ $cat->name }}</td>
                                            <td>{{ $cat->category->id }}|{{ $cat->category->name }}</td>
                                            <td>{{ $cat->child_categories->count() }}</td>
                                            <td>{{ $cat->created_at->diffForHumans() }}</td>
                                            <td class="d-flex gap-2">
                                                

                                                <button class="btn btn-xs btn-warning editsubCategoryBtn"
                                                    data-id="{{ $cat->id }}" data-name="{{ $cat->name }}"
                                                    data-category="{{ $cat->category_id }}" data-bs-toggle="modal"
                                                    data-bs-target="#editSubCategoryModal">
                                                    <i class="fa fa-pencil"></i>
                                                </button>


                                                <form action="{{ route('admin.subcategory.destroy', $cat->id) }}" method="POST"
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
                                            <td colspan="4" class="text-center text-muted">No categories found</td>
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
        <div class="modal fade" id="createsubCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Sub Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.subcategory.store') }}" id="createsubCategoryForm"
                            class="d-flex flex-column gap-3" method="POST">
                            @csrf
                            <select name="category_id" class="form-control form-select">
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
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" form="createsubCategoryForm" class="btn btn-primary">Save SubCategory</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Modals --}}

        {{-- Edit Modal --}}
        <div class="modal fade" id="editSubCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editSubCategoryForm" class="d-flex flex-column gap-3" method="post">
                            @csrf
                            @method('PUT')
                            {{-- Category Dropdown --}}
                            <select name="category_id" class="form-control" id="edit_category_id">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">
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
                            <input type="text" name="name" id="edit_name" class="form-control">
                            @error('name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" form="editSubCategoryForm" class="btn btn-primary">Update Category</button>
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

    // Base URL for update
    const updateSubCategoryBaseUrl = "{{ url('/admin/subcategory') }}";

    // Elements
    const editButtons = document.querySelectorAll('.editsubCategoryBtn');
    const editForm = document.getElementById('editSubCategoryForm');
    const editName = document.getElementById('edit_name');
    const editCategory = document.getElementById('edit_category_id');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {

            // Get data from button
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const categoryId = this.getAttribute('data-category');

            // Fill inputs
            editName.value = name;
            editCategory.value = categoryId;

            // Set form action dynamically
            editForm.action = `${updateSubCategoryBaseUrl}/${id}`;
        });
    });

});
</script>
@endpush
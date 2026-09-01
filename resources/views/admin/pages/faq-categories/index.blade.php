@extends('admin.layout.master')

@section('main')

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    {{-- HEADER --}}
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">FAQ Categories</h5>

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#createFaqCategoryModal">
                            + Create Category
                        </button>
                    </div>

                    <div class="card-body">

                        {{-- SUCCESS MESSAGE --}}
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
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Total FAQs</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Created At</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="200">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($categories as $category)
                                        <tr>
                                            <td>{{ $category->id }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>{{ $category->faqs_count }}</td>
                                            <td>{{ $category->created_at->diffForHumans() }}</td>
                                            <td class="d-flex gap-2">

                                                <button class="btn btn-xs btn-warning editFaqCategoryBtn"
                                                    data-id="{{ $category->id }}" data-name="{{ $category->name }}"
                                                    data-bs-toggle="modal" data-bs-target="#editFaqCategoryModal">
                                                    <i class="fa fa-pencil"></i>
                                                </button>

                                                <form action="{{ route('admin.faq-categories.destroy', $category->id) }}"
                                                    method="POST" onsubmit="return confirm('Are you sure?')">
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
                                            <td colspan="5" class="text-center text-muted">No categories found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{ $categories->links() }}
                    </div>
                </div>
            </div>
        </div>

        {{-- Create Modal --}}
        <div class="modal fade" id="createFaqCategoryModal" tabindex="-1" aria-labelledby="createFaqCategoryLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="createFaqCategoryLabel">Create FAQ Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.faq-categories.store') }}" id="createFaqCategoryForm"
                            class="d-flex flex-column gap-3" method="POST">
                            @csrf
                            <input type="text" name="name" placeholder="Enter Category Name" class="form-control">
                            @error('name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" form="createFaqCategoryForm" class="btn btn-primary">Save Category</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Create Modal --}}

        {{-- Edit Modal --}}
        <div class="modal fade" id="editFaqCategoryModal" tabindex="-1" aria-labelledby="editFaqCategoryLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="editFaqCategoryLabel">Update Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editFaqCategoryForm" class="d-flex flex-column gap-3" method="post">
                            @csrf
                            @method('PUT')

                            <input type="text" name="name" id="edit_faq_category_name" class="form-control">
                            @error('name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" form="editFaqCategoryForm" class="btn btn-primary">Update Category</button>
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

    const updateFaqCategoryBaseUrl = "{{ url('/admin/faq-categories') }}";

    const editButtons = document.querySelectorAll('.editFaqCategoryBtn');
    const editForm = document.getElementById('editFaqCategoryForm');
    const editName = document.getElementById('edit_faq_category_name');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {

            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');

            editName.value = name;
            editForm.action = `${updateFaqCategoryBaseUrl}/${id}`;
        });
    });

});
</script>
@endpush
@extends('admin.layout.master')

@section('main')

    <div class="container-fluid py-4">

        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="card">

                    {{-- HEADER --}}
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Category</h5>

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#createCategoryModal">
                            + Create Category
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
                                         <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">SubCategories
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Created At</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($categories as $cat)
                                        <tr class="text-sm">
                                            <td>{{ $cat->id }}</td>
                                            <td>{{ $cat->name }}</td>
                                            <td>{{ $cat->sub_categories->count() }}</td>
                                            <td>{{ $cat->created_at->diffForHumans() }}</td>
                                            <td class="d-flex gap-2">
                                                <button 
                                                    class="btn btn-xs btn-warning editCategoryBtn"
                                                    data-id="{{ $cat->id }}"
                                                    data-name="{{ $cat->name }}"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editCategoryModal">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                <form action="{{ route('admin.category.destroy', $cat->id) }}" method="POST"
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
                                            <td colspan="4" class="text-center text-muted">
                                                No categories found
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>

                    </div>

                </div>

            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="createCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.category.store') }}" id="createCategoryForm" class="d-flex flex-column gap-3" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" id="name" name="name" placeholder="enter name" class="form-control">

                            </div>
                            @error('name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" form="createCategoryForm" class="btn btn-primary">Save Category</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Modals --}}
        {{-- Edit Modal --}}
        <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editCategoryForm" class="d-flex flex-column gap-3" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="editName">Name</label>
                                <input type="text" id="editName" name="name" placeholder="enter name" class="form-control">
                            </div>
                            @error('name')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" form="editCategoryForm" class="btn btn-primary">Update Category</button>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Edit Modal --}}
    </div>

@endsection
@push('js')
<script>
    //DOM = document object modal
    const updateCategoryBaseUrl = "{{ url('/admin/category') }}";
document.addEventListener('DOMContentLoaded', function () {

    const editButtons = document.querySelectorAll('.editCategoryBtn');
    const editForm = document.getElementById('editCategoryForm');
    const editName = document.getElementById('editName');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {

            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');

            // fill input
            editName.value = name;

            // set form action dynamically
            editForm.action = `${updateCategoryBaseUrl}/${id}`;
            // OR if you prefer named route style, keep reading below

        });
    });

});
</script>
    
@endpush
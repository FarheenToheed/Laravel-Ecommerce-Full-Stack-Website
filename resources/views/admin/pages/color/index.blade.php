@extends('admin.layout.master')

@section('main')

    <div class="container-fluid py-4">

        <div class="row justify-content-center">
            <div class="col-md-10">

                <div class="card">

                    {{-- HEADER --}}
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Color</h5>

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#createColorModal">
                            + Create Color
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
                                         <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Code
                                        </th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Created At</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Actions</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse ($color as $col)
                                        <tr class="text-sm">
                                            <td>{{ $col->id }}</td>
                                            <td>{{ $col->name }}</td>
                                            <td>{{ $col->code }}</td>
                                            <td>{{ $col->created_at->diffForHumans() }}</td>
                                            <td class="d-flex gap-2">
                                                <button 
                                                    class="btn btn-xs btn-warning editColorBtn"
                                                    data-id="{{ $col->id }}"
                                                    data-name="{{ $col->name }}"
                                                    data-code="{{ $col->code }}"
                                                    data-bs-toggle="modal" 
                                                    data-bs-target="#editColorModal">
                                                    <i class="fa fa-pencil"></i>
                                                </button>
                                                <form action="{{ route('admin.color.destroy', $col->id) }}" method="POST"
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
                                                No Color found
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
        <div class="modal fade" id="createColorModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Create Color</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.color.index') }}" id="createColorForm" class="d-flex flex-column gap-3" method="post">
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
                            
                            <div class="form-group">
                                <label for="code">Code</label>
                                <input type="text" id="code" name="code" placeholder="enter code" class="form-control">

                            </div>
                            @error('code')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" form="createColorForm" class="btn btn-primary">Save <Colgroup></Colgroup></button>
                    </div>
                </div>
            </div>
        </div>
        {{-- End Modals --}}
        {{-- Edit Modal --}}
        <div class="modal fade" id="editColorModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Color</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editColorForm" class="d-flex flex-column gap-3" method="post">
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

                            <div class="form-group">
                                <label for="editColor">Color</label>
                                <input type="text" id="editColor" name="code" placeholder="enter color" class="form-control">
                            </div>
                            @error('color')
                                <div class="alert alert-danger">
                                    {{ $message }}
                                </div>
                            @enderror
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" form="editColorForm" class="btn btn-primary">Update Color</button>
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

    // Base URL for update route (IMPORTANT: color not category)
    const updateColorBaseUrl = "{{ url('/admin/color') }}";

    // All edit buttons
    const editButtons = document.querySelectorAll('.editColorBtn');

    // Form + inputs
    const editForm = document.getElementById('editColorForm');
    const editName = document.getElementById('editName');
    const editCode = document.getElementById('editColor');

    editButtons.forEach(button => {
        button.addEventListener('click', function () {

            // Get data from button
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            const code = this.getAttribute('data-code');

            // Fill inputs in modal
            editName.value = name;
            editCode.value = code;

            // Set form action dynamically
            editForm.action = `${updateColorBaseUrl}/${id}`;
        });
    });

});
</script>
@endpush
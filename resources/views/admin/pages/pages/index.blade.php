@extends('admin.layout.master')

@section('main')

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Pages</h5>

                        <a href="{{ route('admin.pages.create') }}" class="btn btn-primary">
                            + Create Page
                        </a>
                    </div>

                    <div class="card-body">

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered align-middle" style="table-layout: fixed; width: 100%;">
                                <thead>
                                    <tr>
                                        <th class="text-center" style="width: 8%;">ID</th>
                                        <th class="text-center" style="width: 30%;">Page Name</th>
                                        <th class="text-center" style="width: 30%;">Page Link</th>
                                        <th class="text-center" style="width: 17%;">Created At</th>
                                        <th class="text-center" style="width: 15%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($pages as $page)
                                        <tr>
                                            <td class="text-center">{{ $page->id }}</td>
                                            <td class="text-truncate" style="max-width: 100%;">{{ $page->page_name }}</td>
                                            <td class="text-truncate" style="max-width: 100%;">/{{ $page->page_link }}</td>
                                            <td class="text-center">{{ $page->created_at->diffForHumans() }}</td>
                                            <td class="text-center">
                                                <div class="d-flex gap-1 justify-content-center">
                                                    <a href="{{ route('admin.pages.edit', $page->id) }}" class="btn btn-xs btn-warning">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>

                                                    <form action="{{ route('admin.pages.destroy', $page->id) }}" method="POST"
                                                        onsubmit="return confirm('Are you sure?')">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button class="btn btn-xs btn-danger" type="submit">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">No pages found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{ $pages->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
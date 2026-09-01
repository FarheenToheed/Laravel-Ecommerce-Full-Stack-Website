@extends('admin.layout.master')

@section('main')

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-11">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Blogs</h5>

                        <a href="{{ route('admin.blogs.create') }}" class="btn btn-primary">
                            + Create Blog
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
                                        <th class="text-center" style="width: 8%;">Image</th>
                                        <th class="text-center" style="width: 25%;">Title</th>
                                        <th class="text-center" style="width: 32%;">Short Description</th>
                                        <th class="text-center" style="width: 20%;">Created At</th>
                                        <th class="text-center" style="width: 15%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($blogs as $blog)
                                        <tr>
                                            <td class="text-center">
                                                @if($blog->image)
                                                    <img src="{{ asset('storage/' . $blog->image) }}" width="50" height="50" style="object-fit: cover; border-radius: 6px;">
                                                @else
                                                    <span class="text-muted">-</span>
                                                @endif
                                            </td>
                                            <td class="text-truncate" style="max-width: 100%;">{{ $blog->title }}</td>
                                            <td class="text-truncate" style="max-width: 100%;">{{ $blog->short_description }}</td>
                                            <td class="text-center">{{ $blog->created_at->diffForHumans() }}</td>
                                            <td class="text-center">
                                                <div class="d-flex gap-1 justify-content-center">
                                                    <a href="{{ route('admin.blogs.edit', $blog->id) }}" class="btn btn-xs btn-warning">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>

                                                    <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST"
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
                                            <td colspan="5" class="text-center text-muted">No blogs found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{ $blogs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
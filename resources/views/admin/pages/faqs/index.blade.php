@extends('admin.layout.master')

@section('main')

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    {{-- HEADER --}}
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">FAQs</h5>

                        <a href="{{ route('admin.faqs.create') }}" class="btn btn-primary">
                            + Create FAQ
                        </a>
                    </div>

                    <div class="card-body">

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered align-middle">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="50">ID</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Question</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="150">Category</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="130">Created At</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 text-center" width="120">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($faqs as $faq)
                                        <tr>
                                            <td>{{ $faq->id }}</td>
                                            <td>
                                                <span class="text-truncate d-inline-block" style="max-width: 100%;" title="{{ $faq->question }}">
                                                    {{ \Illuminate\Support\Str::words($faq->question, 4, '...') }}
                                                </span>
                                            </td>
                                            <td>{{ $faq->faqcategory->name ?? '-' }}</td>
                                            <td>{{ $faq->created_at->diffForHumans() }}</td>
                                            <td>
                                                <div class="d-flex gap-1 justify-content-center">
                                                    <a href="{{ route('admin.faqs.show', $faq->id) }}" class="btn btn-xs btn-info">
                                                        <i class="fa fa-eye"></i>
                                                    </a>

                                                    <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="btn btn-xs btn-warning">
                                                        <i class="fa fa-pencil"></i>
                                                    </a>

                                                    <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST"
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
                                            <td colspan="5" class="text-center text-muted">No FAQs found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        {{ $faqs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
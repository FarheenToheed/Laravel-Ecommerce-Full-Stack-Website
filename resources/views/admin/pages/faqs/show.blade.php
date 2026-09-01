@extends('admin.layout.master')

@section('main')

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    {{-- HEADER --}}
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">FAQ Details</h5>

                        <a href="{{ route('admin.faqs.index') }}" class="btn btn-primary">
                            Back to FAQs
                        </a>
                    </div>

                    <div class="card-body">

                        @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="row g-3 justify-content-center">

                            {{-- Details Card --}}
                            <div class="col-md-8">
                                <div class="card h-100">
                                    <div class="card-body">

                                        {{-- Category Badge --}}
                                        <div class="d-flex justify-content-between align-items-center mb-1">
                                            <h5 class="card-title mb-0 fw-semibold">FAQ #{{ $faq->id }}</h5>
                                            <span style="font-size: 11px; font-weight: 500; padding: 3px 10px; border-radius: 20px;
                                                background: #EAF3DE; color: #3B6D11;">
                                                {{ $faq->faqcategory->name ?? 'No Category' }}
                                            </span>
                                        </div>

                                        <p class="text-muted mb-2" style="font-size: 12px;">Details</p>
                                        <hr class="my-2">

                                        {{-- Info Rows --}}
                                        <div class="d-flex justify-content-between align-items-center py-1" style="border-bottom: 1px dashed #f0f0f0;">
                                            <span style="font-size: 13px; color: #888; font-weight: 500;">Category</span>
                                            <span style="font-size: 13px; color: #333; font-weight: 500;">
                                                {{ $faq->faqcategory->id ?? '-' }} | {{ $faq->faqcategory->name ?? '-' }}
                                            </span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center py-1" style="border-bottom: 1px dashed #f0f0f0;">
                                            <span style="font-size: 13px; color: #888; font-weight: 500;">Created At</span>
                                            <span style="font-size: 13px; color: #333; font-weight: 500;">{{ $faq->created_at->format('d M, Y - h:i A') }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between align-items-center py-1" style="border-bottom: 1px dashed #f0f0f0;">
                                            <span style="font-size: 13px; color: #888; font-weight: 500;">Last Updated</span>
                                            <span style="font-size: 13px; color: #333; font-weight: 500;">{{ $faq->updated_at->diffForHumans() }}</span>
                                        </div>

                                        <hr class="my-2">

                                        <p class="mb-1" style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: #aaa;">Question</p>
                                        <p style="font-size: 14px; color: #333; font-weight: 500;">{{ $faq->question }}</p>

                                        <p class="mb-1" style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: #aaa;">Answer</p>
                                        <p style="font-size: 13px; color: #555; white-space: pre-line;">{{ $faq->answer }}</p>

                                        <div class="mt-4 d-flex gap-2">
                                            <a href="{{ route('admin.faqs.edit', $faq->id) }}" class="btn btn-warning btn-sm">
                                                <i class="fa fa-pencil"></i> Edit
                                            </a>

                                            <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST"
                                                onsubmit="return confirm('Are you sure?')">
                                                @csrf
                                                @method('DELETE')

                                                <button class="btn btn-danger btn-sm" type="submit">
                                                    <i class="fa fa-trash"></i> Delete
                                                </button>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
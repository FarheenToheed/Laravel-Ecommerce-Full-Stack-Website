@extends('admin.layout.master')

@section('main')

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Create FAQ</h5>
                        <a href="{{ route('admin.faqs.index') }}" class="btn btn-secondary btn-sm">Back</a>
                    </div>

                    <div class="card-body">
                        <form action="{{ route('admin.faqs.store') }}" method="POST" class="d-flex flex-column gap-3">
                            @csrf

                            <div>
                                <label class="form-label">Category</label>
                                <select name="faq_category_id" class="form-control form-select">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected(old('faq_category_id') == $category->id)>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('faq_category_id')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label">Question</label>
                                <input type="text" name="question" value="{{ old('question') }}" class="form-control" placeholder="Enter Question">
                                @error('question')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <label class="form-label">Answer</label>
                                <textarea name="answer" rows="6" class="form-control" placeholder="Enter Answer">{{ old('answer') }}</textarea>
                                @error('answer')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <div>
                                <button type="submit" class="btn btn-primary">Save FAQ</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
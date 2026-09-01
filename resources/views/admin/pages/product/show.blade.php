@extends('admin.layout.master')

@section('main')

    <div class="container-fluid py-4">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    {{-- HEADER --}}
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Product</h5>

                        <a href="{{ route('admin.product.index') }}" class="btn btn-primary">
                            Products View
                        </a>
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
                        {{-- card for showing product details --}}
                        <div class="row g-3 align-items-start">

    {{-- Image Card --}}
    <div class="col-md-6">
        <div class="card h-100">

            <img id="mainImage{{ $product->id }}"
                src="{{ asset('storage/' . $product->product_images->first()->image_path) }}"
                class="card-img-top"
                style="height: 250px; object-fit: cover; transition: opacity 0.3s ease;"
                alt="Main Image">

            @if($product->product_images->count() > 1)
                <div class="d-flex gap-1 p-2 flex-wrap">

                    @foreach($product->product_images->take(3) as $img)
                        <img src="{{ asset('storage/' . $img->image_path) }}"
                            onclick="changeImage('{{ asset('storage/' . $img->image_path) }}', {{ $product->id }})"
                            style="width: 60px; height: 60px; object-fit: cover;
                                   border-radius: 6px; border: 2px solid #ddd; cursor: pointer;">
                    @endforeach

                    @if($product->product_images->count() > 3)
                        <div onclick="showMoreImages({{ $product->id }})"
                            style="width: 60px; height: 60px; border-radius: 6px;
                                   border: 1px dashed #aaa; background: #f9f9f9;
                                   display: flex; align-items: center; justify-content: center;
                                   cursor: pointer; font-size: 11px; color: #666; text-align: center;">
                            +{{ $product->product_images->count() - 3 }}<br>more
                        </div>
                    @endif

                </div>

                <div id="extraImages{{ $product->id }}"
                    class="d-flex gap-1 px-2 pb-2 flex-wrap"
                    style="display: none !important;">
                    @foreach($product->product_images->skip(3) as $img)
                        <img src="{{ asset('storage/' . $img->image_path) }}"
                            onclick="changeImage('{{ asset('storage/' . $img->image_path) }}', {{ $product->id }})"
                            style="width: 60px; height: 60px; object-fit: cover;
                                   border-radius: 6px; border: 2px solid #ddd; cursor: pointer;">
                    @endforeach
                </div>

                <div class="px-2 pb-2">
                    <small id="showMoreBtn{{ $product->id }}"
                        onclick="showMoreImages({{ $product->id }})"
                        style="color: #0d6efd; cursor: pointer; font-size: 12px;">
                        Show more images
                    </small>
                </div>
            @endif

        </div>
    </div>

    {{-- Details Card --}}
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-body">

                {{-- Name + Status --}}
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <h5 class="card-title mb-0 fw-semibold">{{ $product->name }}</h5>
                    <span style="font-size: 11px; font-weight: 500; padding: 3px 10px; border-radius: 20px;
                        background: {{ $product->status === 'active' ? '#EAF3DE' : '#FCEBEB' }};
                        color: {{ $product->status === 'active' ? '#3B6D11' : '#A32D2D' }};">
                        {{ $product->status === 'active' ? 'Active' : 'Inactive' }}
                    </span>
                </div>

                <p class="text-muted mb-2" style="font-size: 12px;">Details</p>
                <hr class="my-2">

                {{-- Info Rows --}}
                <div class="d-flex justify-content-between align-items-center py-1" style="border-bottom: 1px dashed #f0f0f0;">
                    <span style="font-size: 13px; color: #888; font-weight: 500;">Sub Category</span>
                    <span style="font-size: 13px; color: #333; font-weight: 500;">{{ $product->sub_category->id }} | {{ $product->sub_category->name }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center py-1" style="border-bottom: 1px dashed #f0f0f0;">
                    <span style="font-size: 13px; color: #888; font-weight: 500;">Child Category</span>
                    <span style="font-size: 13px; color: #333; font-weight: 500;">{{ $product->child_category->id }} | {{ $product->child_category->name }}</span>
                </div>
                <div class="d-flex justify-content-between align-items-center py-1" style="border-bottom: 1px dashed #f0f0f0;">
                    <span style="font-size: 13px; color: #888; font-weight: 500;">Size Guide</span>
                    <span style="font-size: 13px; color: #333; font-weight: 500;">{{ $product->size_guide }}</span>
                </div>

                <hr class="my-2">

                <p class="mb-1" style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: #aaa;">Detail</p>
                <p style="font-size: 13px; color: #555;">{{ $product->details }}</p>

                <p class="mb-1" style="font-size: 11px; font-weight: 600; text-transform: uppercase; letter-spacing: 0.5px; color: #aaa;">Description</p>
                <p style="font-size: 13px; color: #555;">{{ $product->description }}</p>

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
@push('js')
    <script>
        function changeImage(src, id) {
            const main = document.getElementById('mainImage' + id);
            main.style.opacity = '0';
            setTimeout(() => {
                main.src = src;
                main.style.opacity = '1';
            }, 150);
        }

        function showMoreImages(id) {
            const extra = document.getElementById('extraImages' + id);
            const btn = document.getElementById('showMoreBtn' + id);
            extra.style.display = 'flex';
            btn.style.display = 'none';
        }
    </script>
@endpush
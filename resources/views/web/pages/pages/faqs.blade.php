@extends('web.layout.master')

@section('title', 'Faqs– Sapphire')

@section('content')

    <div class="faq-page">
        <div class="faq-container">

            <h1 class="faq-heading">FAQs</h1>

            <div class="faq-accordion">

                @foreach ($categories as $category)
                    <div class="faq-category {{ $loop->first ? 'active' : '' }}">

                        <button type="button" class="faq-category-header" data-target="faq-body-{{ $category->id }}">
                            <span>{{ $category->name }}</span>
                            <span class="faq-toggle-icon">{{ $loop->first ? '−' : '+' }}</span>
                        </button>

                        <div class="faq-category-body" id="faq-body-{{ $category->id }}"
                            style="max-height: {{ $loop->first ? '9999px' : '0' }};">
                            <div class="faq-category-body-inner">

                                @foreach ($category->faqs as $i => $faq)
                                    <div class="faq-item">
                                        <p class="faq-question">{{ $i + 1 }}. {{ $faq->question }}</p>
                                        <p class="faq-answer">{!! nl2br(e($faq->answer)) !!}</p>
                                    </div>
                                @endforeach

                            </div>
                        </div>

                    </div>
                @endforeach

            </div>

        </div>
    </div>
@endsection
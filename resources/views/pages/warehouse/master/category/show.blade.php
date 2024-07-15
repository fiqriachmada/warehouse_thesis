@extends('layouts.warehouse')

@section('title')
    Master - Detail Product Category
@endsection

@section('section-warehouse')
<div class="container-xxl flex-grow-1 container-p-y">
    <h3>{{ $category->name }}</h3>
    <div class="row">
        @foreach ($category->product as $product)
        <div class="col-xl-4 col-lg-4 col-md-6 order-1 order-md-0 mb-5">
            <div class="card">
                <div class="swiper swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden swiper-container" id="swiper-with-progress">
                    <div class="swiper-wrapper" id="swiper-wrapper-{{ $product->id }}" aria-live="polite" style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);">
                    @foreach ($product->getMedia('product_images') as $media)
                        <div class="swiper-slide" style="background-image: url({{ $media->getUrl() }}); background-size: cover; height: 500px" role="group"></div>
                    @endforeach
                    </div>
                    <div class="swiper-pagination swiper-pagination-progressbar swiper-pagination-horizontal"><span class="swiper-pagination-progressbar-fill" style="transform: translate3d(0px, 0px, 0px) scaleX(0.4) scaleY(1); transition-duration: 300ms;"></span></div>
                    <div class="swiper-button-next swiper-button-white custom-icon" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-{{ $product->id }}" aria-disabled="false"></div>
                    <div class="swiper-button-prev swiper-button-white custom-icon" tabindex="0" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-{{ $product->id }}" aria-disabled="false"></div>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                </div>
                <div class="card-body">
                    <h5 class="card-title text-capitalize">{{ $product->name }}</h5>
                    <p class="card-text">{{ $product->description }}.</p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Weight <span style="float: right">@convertGramToKg($product->weight)</span></li>
                    @if ($product->length != '')
                    <li class="list-group-item">Length <span style="float: right">@convertCmToM($product->length)</span></li>
                    @endif
                    @if ($product->width != '')
                    <li class="list-group-item">Width <span style="float: right">@convertCmToM($product->width)</span></li>
                    @endif
                    @if ($product->height != '')
                    <li class="list-group-item">Height <span style="float: right">@convertCmToM($product->height)</span></li>
                    @endif
                    <li class="list-group-item">Expired Date <span style="float: right">{{ $product->expired_date != '' ? \Carbon\Carbon::parse($product->expired_date)->format('d/m/Y') : '-' }}</span></li>
                    <li class="list-group-item">Status 
                        <span style="float: right" class="text-capitalize">
                            @if ($product->status == 'active')
                                <span class="badge bg-success d-flex justify-content-center">{{ $product->status }}</span>
                            @elseif ($product->status == 'damaged')
                                <span class="badge bg-danger d-flex justify-content-center">{{ $product->status }}</span>
                            @elseif ($product->status == 'inactive')
                                <span class="badge bg-secondary d-flex justify-content-center">{{ $product->status }}</span>
                            @endif
                        </span>
                    </li>
                    <li class="list-group-item">Availbility Status 
                        <span style="float: right" class="text-capitalize">
                            @if ($product->availability_status == 'available')
                                <span class="badge bg-success d-flex justify-content-center">{{ $product->availability_status }}</span>
                            @elseif ($product->availability_status == 'run_out')
                                <span class="badge bg-secondary d-flex justify-content-center">Run Out Of Stock</span>
                            @endif
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
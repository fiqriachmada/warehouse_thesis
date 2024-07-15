@extends('layouts.guest')

@section('title')
    Warehouse - Properties
@endsection

@section('section-guest')
<section class="section blog-wrap bg-gray">
	<div class="container">
		<div class="row">
			@php
				$warehouse_subscriptions = [];
			@endphp
			@foreach ($warehouses as $warehouse)
				@foreach ($warehouse->warehouse_subscription as $warehouse_subscription)
					@php
						$warehouse_subscriptions = $warehouse_subscription->id;
					@endphp
				@endforeach
			
				<div class="col-lg-6 col-md-6 mb-5">
					<div class="blog-item">
						<div class="swiper swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden swiper-container" id="swiper-with-progress">
							<div class="swiper-wrapper" id="swiper-wrapper-{{ $warehouse->id }}" aria-live="polite" style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);">
							@foreach ($warehouse->getMedia('warehouse_images') as $media)
								<div class="swiper-slide" style="background-image: url({{ $media->getUrl() }}); background-size: cover; height: 500px" role="group"></div>
							@endforeach
							</div>
							<div class="swiper-pagination swiper-pagination-progressbar swiper-pagination-horizontal"><span class="swiper-pagination-progressbar-fill" style="transform: translate3d(0px, 0px, 0px) scaleX(0.4) scaleY(1); transition-duration: 300ms;"></span></div>
							<div class="swiper-button-next swiper-button-white custom-icon" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-{{ $warehouse->id }}" aria-disabled="false"></div>
							<div class="swiper-button-prev swiper-button-white custom-icon" tabindex="0" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-{{ $warehouse->id }}" aria-disabled="false"></div>
							<span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
						</div>

						<div class="blog-item-content bg-white p-5">
							<div class="blog-item-meta bg-gray pt-2 pb-1 px-3 d-flex justify-content-between">
								<span class="text-muted text-capitalize d-inline-block me-3"><i class="ti-package me-2"></i> {{ $warehouse->warehouse_category->category }}</span>
								<span class="text-muted text-capitalize d-inline-block me-3"><i class="ti-bar-chart me-2"></i>{{ \App\Models\DetailTransaction::join('transactions', 'transactions.id', 'detail_transactions.transaction_id')->whereIn('warehouse_subscription_id', [$warehouse_subscriptions])->where('transactions.status', 'confirmed')->count() }} Reserved</span>
								<span class="text-muted text-capitalize d-inline-block me-3"><i class="ti-unlink me-1"></i> 
								@if ($warehouse->status == 'available')
									<div class="badge bg-success">{{ $warehouse->status }}</div>
								@elseif ($warehouse->status == 'unavailable' || $warehouse->status == 'rented')
									<div class="badge bg-danger">{{ $warehouse->status }}</div>
								@elseif ($warehouse->status == 'maintenance' || $warehouse->status == 'damaged')
									<div class="badge bg-warning">{{ $warehouse->status }}</div>
								@endif
								</span>
							</div>                        

							<h3 class="mt-3 mb-2 text-capitalize"><a href="{{ route('our.properties.show', $warehouse->id) }}">{{ $warehouse->name }}</a></h3>
							<table style="width:100%" class="mb-4">
								<tr>
									<th style="width: 40%">Capacity:</th>
									<td>{{ $warehouse->capacity }}m<sup>3</sup></td>
								</tr>
								<tr>
									<th>Surface Area:</th>
									<td>{{ $warehouse->surface_area }}m<sup>3</sup></td>
								</tr>
								<tr>
									<th>Building Area:</th>
									<td>{{ $warehouse->building_area }}m<sup>3</sup></td>
								</tr>
								<tr>
									<th>Country:</th>
									<td>{{ $warehouse->country->name }}</td>
								</tr>
								<tr>
									<th>Address:</th>
									<td>{{ $warehouse->address }}</td>
								</tr>
							</table>

							<a href="{{ route('our.properties.show', $warehouse->id) }}" class="btn btn-small btn-main btn-round-full">Learn More</a>
							<a href="{{ route('login.user') }}" class="btn btn-small-primary btn-primary btn-round-full" style="float: right">Reserve Now</a>
						</div>
					</div>
				</div>
			@endforeach
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var swipers = document.querySelectorAll('.swiper-container');

        swipers.forEach(function (swiperElement) {
            var swiper = new Swiper(swiperElement, {
                slidesPerView: 'auto',
                pagination: {
                    type: 'progressbar',
                    el: '.swiper-pagination'
                },
                navigation: {
                    prevEl: '.swiper-button-prev',
                    nextEl: '.swiper-button-next'
                }
            });
        });
    });
</script>
@endpush
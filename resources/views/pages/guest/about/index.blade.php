@extends('layouts.guest')

@section('title')
    Warehouse - About Us
@endsection

@section('section-guest')
<section class="section about-2 position-relative">
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class="about-item pr-3 mb-5 mb-lg-0">
					<span class="h6 text-color">What we are</span>
					<h2 class="mt-3 mb-4 position-relative content-title">Innovative Minds, Strategic Solutions</h2>
					<p class="mb-5">As a dynamic team, we excel in providing consulting services that elevate your business. Our focus is on optimizing processes and facilitating growth through innovative management strategies.</p>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="about-item-img">
					<img loading="lazy" src="{{ asset('assets/images/bg/home-13.jpg') }}" alt="about-image" class="img-fluid">
				</div>
			</div>
		</div>
	</div>
</section>

<section class="about-info section pt-0">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="about-info-item mb-4 mb-lg-0">
					<h3 class="mb-3"><span class="text-color mr-2 text-md ">01.</span>Our Mission</h3>
					<p>Striving for Excellence, Embracing Challenges We passionately pursue excellence, facing challenges head-on, and embracing distinct opportunities for growth.</p>
				</div>		
			</div>
			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="about-info-item mb-4 mb-lg-0">
					<h3 class="mb-3"><span class="text-color mr-2 text-md">02.</span>Vission</h3>
					<p>Inspiring Futures, Redefining Success Our vision goes beyond today, as we inspire futures and redefine success through distinctive approaches and continuous innovation.</p>
				</div>		
			</div>
			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="about-info-item mb-4 mb-lg-0">
					<h3 class="mb-3"><span class="text-color mr-2 text-md">03.</span>Our Approach</h3>
					<p>Tailored Strategies, Seamless Execution Crafting unique strategies, we seamlessly execute plans, ensuring distinctiveness and maximizing the delight of every endeavor.</p>
				</div>		
			</div>
		</div>
	</div>
</section>

<section class="section counter bg-counter">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="counter-item text-center mb-5 mb-lg-0">
					<i class="ti-check color-one text-md"></i>
					<h3 class="mt-2 mb-0 text-black"><span class="counter-stat font-weight-bold">{{ $transactions }}</span></h3>
					<p class="text-black-50">Reserved Done</p>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="counter-item text-center mb-5 mb-lg-0">
					<i class="ti-list color-one text-md"></i>
					<h3 class="mt-2 mb-0 text-black"><span class="counter-stat font-weight-bold">{{ $warehouses }}</span></h3>
					<p class="text-black-50">Our Warehouse</p>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="counter-item text-center mb-5 mb-lg-0">
					<i class="ti-user color-one text-md"></i>
					<h3 class="mt-2 mb-0 text-black"><span class="counter-stat font-weight-bold">{{ $users }}</span></h3>
					<p class="text-black-50">Our Tenant</p>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="counter-item text-center">
					<i class="ti-medall color-one  text-md"></i>
					<h3 class="mt-2 mb-0 text-white"><span class="counter-stat font-weight-bold">14</span></h3>
					<p class="text-white-50">Award Winner </p>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
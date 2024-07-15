@extends('layouts.guest')

@section('title')
    Warehouse - Our Service
@endsection

@section('section-guest')
<section class="section service border-top pb-5">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-7 text-center">
				<div class="section-title">
					<span class="h6 text-color">Our Services</span>
					<h2 class="mt-3 content-title ">We provide a wide range of creative services </h2>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="service-item mb-5">
					<i class="ti-desktop"></i>
					<h4 class="mb-3">Web Innovation Partnership.</h4>
					<p>As your strategic collaborator in web development, we complement your internal team's efforts instead of replacing them.</p>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="service-item mb-5">
					<i class="ti-layers"></i>
					<h4 class="mb-3">Creative Interface Alliances.</h4>
					<p>In the dynamic field of interface design, we're not substitutes for your internal team; we're creative allies fostering innovative interfaces.</p>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="service-item mb-5">
					<i class="ti-bar-chart"></i>
					<h4 class="mb-3">Strategic Business Collaborations.</h4>
					<p>In the realm of business consulting, we're not here to replace your internal team; we're strategic collaborators shaping successful business ventures.</p>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="service-item mb-5">
					<i class="ti-vector"></i>
					<h4 class="mb-3">Brand-building Companionship.</h4>
					<p>Beyond branding, we don't replace your internal efforts; we're your trusted companions in building and elevating your brand.</p>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="service-item mb-5">
					<i class="ti-android"></i>
					<h4 class="mb-3">App Development Associates.</h4>
					<p>In app development, we don't replace your internal team; we're your dedicated associates in bringing your app ideas to life.</p>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="service-item mb-5">
					<i class="ti-pencil-alt"></i>
					<h4 class="mb-3">Collaborative Content Creation.</h4>
					<p>Beyond content creation, we're not a substitute for your team; we're your collaborative content creators, infusing creativity into every project.</p>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="service-item mb-5">
					<i class="ti-layers"></i>
					<h4 class="mb-3">Design Partnerships.</h4>
					<p>Within the realm of interface design, we're not replacing your internal team; we're your design partners crafting seamless and engaging interfaces.</p>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="service-item mb-5">
					<i class="ti-bar-chart"></i>
					<h4 class="mb-3">Consulting Allies.</h4>
					<p>In business consulting, we're not a replacement for your internal team; we're your consulting allies, working together to achieve strategic goals.</p>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="service-item mb-5">
					<i class="ti-vector"></i>
					<h4 class="mb-3">Strategic Branding Partners.</h4>
					<p>In the world of branding, we're not here to replace your internal team; we're your strategic partners, elevating your brand to new heights.</p>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="cta-2">
	<div class="container">
		<div class="cta-block-2 bg-gray p-5 rounded border-1">
			<div class="row justify-content-center align-items-center ">
				<div class="col-lg-7">
					<span class="text-color">Elevate every business</span>
					<h2 class="mt-2 mb-4 mb-lg-0">Entrust success to our expert team</h2>
				</div>
				<div class="col-lg-4">
					<a href="{{ route('contact') }}" class="btn btn-main btn-round-full float-lg-right">Contact Us</a>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
@extends('layouts.guest')

@section('title')
    Warehouse - Landing Page
@endsection

@section('section-guest')
<section class="section intro">
	<div class="container">
		<div class="row ">
			<div class="col-lg-8">
				<div class="section-title">
					<span class="h6 text-color ">We specialize in creative warehouse solutions for streamlined operations.</span>
					<h2 class="mt-3 content-title">Collaborating across industries, we efficiently customize warehouse resource management.</h2>
				</div>
			</div>
		</div>
		<div class="row justify-content-center">
			<div class="col-lg-4 col-md-6 col-12">
				<div class="intro-item mb-5 mb-lg-0">
					<i class="ti-desktop color-one"></i>
					<h4 class="mt-4 mb-3">Innovative and adaptable design solutions for your logistics optimization</h4>
					<p>Revolutionize your logistics with our innovative and adaptable solutions designed to optimize your operations effectively.</p>
				</div>
			</div>
			<div class="col-lg-4 col-md-6">
				<div class="intro-item mb-5 mb-lg-0">
					<i class="ti-medall color-one"></i>
					<h4 class="mt-4 mb-3">A recognized and licensed partner in optimizing storage functionalities</h4>
					<p>As a distinguished and licensed partner, we specialize in enhancing storage functionalities to ensure seamless and efficient warehouse management.</p>
				</div>
			</div>
			<div class="col-lg-4 col-md-12">
				<div class="intro-item">
					<i class="ti-layers-alt color-one"></i>
					<h4 class="mt-4 mb-3">Elevate your online presence with expertly crafted logistics websites.</h4>
					<p>Enhance your online visibility with our meticulously crafted logistics websites, expertly designed to represent your storage solutions in the digital realm.</p>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section counter">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="counter-item text-center mb-5 mb-lg-0">
					<h3 class="mb-0"><span class="counter-stat font-weight-bold">{{ $transactions }}</span></h3>
					<p class="text-muted">Reserved Done</p>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="counter-item text-center mb-5 mb-lg-0">
					<h3 class="mb-0"><span class="counter-stat font-weight-bold">{{ $warehouses }}</span></h3>
					<p class="text-muted">Our Warehouse</p>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="counter-item text-center mb-5 mb-lg-0">
					<h3 class="mb-0"><span class="counter-stat font-weight-bold">{{ $users }}</span></h3>
					<p class="text-muted">Our Tenant</p>
				</div>
			</div>
			<div class="col-lg-3 col-md-6 col-sm-6">
				<div class="counter-item text-center">
					<h3 class="mb-0"><span class="counter-stat font-weight-bold">14</span></h3>
					<p class="text-muted">Award Winner </p>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section service border-top">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-7 text-center">
				<div class="section-title">
					<span class="h6 text-color">Our Services</span>
					<h2 class="mt-3 content-title ">We provide a wide range of creative services </h2>
				</div>
			</div>
		</div>

		<div class="row justify-content-center">
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
				<div class="service-item mb-5 mb-lg-0">
					<i class="ti-vector"></i>
					<h4 class="mb-3">Brand-building Companionship.</h4>
					<p>Beyond branding, we don't replace your internal efforts; we're your trusted companions in building and elevating your brand.</p>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="service-item mb-5 mb-lg-0">
					<i class="ti-android"></i>
					<h4 class="mb-3">App Development Associates.</h4>
					<p>In app development, we don't replace your internal team; we're your dedicated associates in bringing your app ideas to life.</p>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 col-sm-6">
				<div class="service-item mb-5 mb-lg-0">
					<i class="ti-pencil-alt"></i>
					<h4 class="mb-3">Collaborative Content Creation.</h4>
					<p>Beyond content creation, we're not a substitute for your team; we're your collaborative content creators, infusing creativity into every project.</p>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section cta">
	<div class="container">
		<div class="row">
			<div class="col-xl-5 col-lg-6">
				<div class="cta-item  bg-white p-5 rounded">
					<span class="h6 text-color">We create for you</span>
					<h2 class="mt-2 mb-4">Trust our expert team for success in your endeavors</h2>
					<p class="lead mb-4">Have a goal in mind? Immediate support awaits you:</p>
					<h3><i class="ti-mobile mr-3 text-color"></i>+23 876 65 455</h3>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section testimonial">
	<div class="container">
		<div class="row">
			<div class="col-lg-7 ">
				<div class="section-title">
					<span class="h6 text-color">Clients testimonial</span>
					<h2 class="mt-3 content-title">Check what's our clients say about us</h2>
				</div>
			</div>
		</div>
	</div>

	<div class="container">
		<div class="row testimonial-wrap">
			<div class="testimonial-item position-relative">
				<i class="ti-quote-left text-color"></i>

				<div class="testimonial-item-content">
					<p class="testimonial-text">Quam maiores perspiciatis temporibus odio reiciendis error alias debitis atque
						consequuntur natus iusto recusandae numquam corrupti facilis blanditiis.</p>

					<div class="testimonial-author">
						<h5 class="mb-0 text-capitalize">Thomas Johnson</h5>
						<p>Excutive Director,themefisher</p>
					</div>
				</div>
			</div>
			<div class="testimonial-item position-relative">
				<i class="ti-quote-left text-color"></i>

				<div class="testimonial-item-content">
					<p class="testimonial-text">Consectetur adipisicing elit. Quam maiores perspiciatis temporibus odio reiciendis
						error alias debitis atque consequuntur natus iusto recusandae .</p>

					<div class="testimonial-author">
						<h5 class="mb-0 text-capitalize">Mickel hussy</h5>
						<p>Excutive Director,themefisher</p>
					</div>
				</div>
			</div>
			<div class="testimonial-item position-relative">
				<i class="ti-quote-left text-color"></i>

				<div class="testimonial-item-content">
					<p class="testimonial-text">Quam maiores perspiciatis temporibus odio reiciendis error alias debitis atque
						consequuntur natus iusto recusandae numquam corrupti.</p>

					<div class="testimonial-author">
						<h5 class="mb-0 text-capitalize">James Watson</h5>
						<p>Excutive Director,themefisher</p>
					</div>
				</div>
			</div>
			<div class="testimonial-item position-relative">
				<i class="ti-quote-left text-color"></i>

				<div class="testimonial-item-content">
					<p class="testimonial-text">Consectetur adipisicing elit. Quam maiores perspiciatis temporibus odio reiciendis
						error alias debitis atque consequuntur natus iusto recusandae .</p>

					<div class="testimonial-author">
						<h5 class="mb-0 text-capitalize">Mickel hussy</h5>
						<p>Excutive Director,themefisher</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="section latest-blog bg-2">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-7 text-center">
				<div class="section-title">
					<span class="h6 text-color">Latest News</span>
					<h2 class="mt-3 content-title text-white">Latest articles to enrich knowledge</h2>
				</div>
			</div>
		</div>

		<div class="row justify-content-center">
			<div class="col-lg-4 col-md-6 mb-5">
				<div class="card bg-transparent border-0">
					<img loading="lazy" src="images/blog/1.jpg" alt="blog" class="img-fluid rounded">

					<div class="card-body mt-2">
						<div class="blog-item-meta">
							<a href="#" class="text-white-50">Design<span class="ml-2 mr-2">/</span></a>
							<a href="#" class="text-white-50">Ui/Ux<span class="ml-2">/</span></a>
							<a href="#" class="text-white-50 ml-2"><i class="fa fa-user mr-2"></i>admin</a>
						</div>

						<h3 class="mt-3 mb-5 lh-36"><a href="#" class="text-white ">How to improve design with typography?</a></h3>

						<a href="blog-single.html" class="btn btn-small btn-solid-border btn-round-full text-white">Learn More</a>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 mb-5">
				<div class="card border-0 bg-transparent">
					<img loading="lazy" src="images/blog/2.jpg" alt="blog" class="img-fluid rounded">

					<div class="card-body mt-2">
						<div class="blog-item-meta">
							<a href="#" class="text-white-50">Design<span class="ml-2 mr-2">/</span></a>
							<a href="#" class="text-white-50">Ui/Ux<span class="ml-2">/</span></a>
							<a href="#" class="text-white-50 ml-2"><i class="fa fa-user mr-2"></i>admin</a>
						</div>

						<h3 class="mt-3 mb-5 lh-36"><a href="#" class="text-white">Interactivity design may connect consumer</a>
						</h3>

						<a href="blog-single.html" class="btn btn-small btn-solid-border btn-round-full text-white">Learn More</a>
					</div>
				</div>
			</div>

			<div class="col-lg-4 col-md-6 mb-5">
				<div class="card border-0 bg-transparent">
					<img loading="lazy" src="images/blog/3.jpg" alt="blog" class="img-fluid rounded">

					<div class="card-body mt-2">
						<div class="blog-item-meta">
							<a href="#" class="text-white-50">Design<span class="ml-2 mr-2">/</span></a>
							<a href="#" class="text-white-50">Ui/Ux<span class="ml-2">/</span></a>
							<a href="#" class="text-white-50 ml-2"><i class="fa fa-user mr-2"></i>admin</a>
						</div>

						<h3 class="mt-3 mb-5 lh-36"><a href="#" class="text-white">Marketing Strategy to bring more affect</a></h3>

						<a href="blog-single.html" class="btn btn-small btn-solid-border btn-round-full text-white">Learn More</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="mt-70 position-relative">
	<div class="container">
		<div class="cta-block-2 bg-gray p-5 rounded border-1">
			<div class="row justify-content-center align-items-center ">
				<div class="col-lg-7">
					<span class="text-color">Elevate every business</span>
					<h2 class="mt-2 mb-4 mb-lg-0">Entrust success to our expert team</h2>
				</div>
				<div class="col-lg-4">
					<a href="{{ route('contact') }}" class="btn btn-main btn-round-full float-lg-right ">Contact Us</a>
				</div>
			</div>
		</div>
	</div>
</section>
@endsection
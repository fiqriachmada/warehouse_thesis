@if (Request::is('/'))
<section class="slider">
	<div class="container">
		<div class="row">
			<div class="col-lg-9 col-md-10">
				<div class="block">
					<span class="d-block mb-3 text-white text-capitalize"><b>Prepare for new future</b></span>
					<h1 class="animated fadeInUp mb-5 text-white"><b>Our work is to <br> contribute to helping <br> your product management.</b></h1>
				</div>
			</div>
		</div>
	</div>
</section>
@elseif (Request::is('about-us'))
<section class="page-title bg-1">
	<div class="container">
	  <div class="row">
		<div class="col-md-12">
		  <div class="block text-center">
			<span class="text-white"><b>About Us</b></span>
			<h1 class="text-capitalize mb-4 text-lg text-white">Our Company</h1>
			<ul class="list-inline">
			  <li class="list-inline-item"><a href="{{ route('/') }}" class="text-white"><b>Home</b></a></li>
			  <li class="list-inline-item"><span class="text-white"><b>/</b></span></li>
			  <li class="list-inline-item text-white"><b>About Us</b></li>
			</ul>
		  </div>
		</div>
	  </div>
	</div>
</section>
@elseif (Request::is('service'))
<section class="page-title bg-1">
	<div class="container">
	  <div class="row">
		<div class="col-md-12">
		  <div class="block text-center">
			<span class="text-white"><b>Our services</b></span>
			<h1 class="text-capitalize mb-4 text-lg text-white"><b>What We Do</b></h1>
			<ul class="list-inline">
			  <li class="list-inline-item"><a href="{{ route('/') }}" class="text-white"><b>Home</b></a></li>
			  <li class="list-inline-item"><span class="text-white"><b>/</b></span></li>
			  <li class="list-inline-item text-white"><b>Our services</b></li>
			</ul>
		  </div>
		</div>
	  </div>
	</div>
</section>
@elseif (Request::is('contact-us'))
<section class="page-title bg-1">
	<div class="container">
	  <div class="row">
		<div class="col-md-12">
		  <div class="block text-center">
			<span class="text-white"><b>Contact Us</b></span>
			<h1 class="text-capitalize mb-4 text-lg text-white"><b>Get in Touch</b></h1>
			<ul class="list-inline">
			  <li class="list-inline-item"><a href="{{ route('/') }}" class="text-white"><b>Home</b></a></li>
			  <li class="list-inline-item"><span class="text-white">/</span></li>
			  <li class="list-inline-item text-white"><b>Contact Us</b></li>
			</ul>
		  </div>
		</div>
	  </div>
	</div>
</section>
@endif
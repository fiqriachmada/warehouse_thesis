@extends('layouts.guest')

@section('title')
    Warehouse - Contact
@endsection

@section('section-guest')
<section class="contact-form-wrap section">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 col-md-12 col-sm-12">
				<form id="contact-form" class="contact__form" method="post" action="{{ route('contact.store') }}">
					@csrf
					<h3 class="text-md mb-4">Direct Contact</h3>
					<div class="form-group">
						<input name="name" type="text" class="form-control" placeholder="Your Name" required="">
					</div>
					<div class="form-group">
						<input name="email" type="email" class="form-control" placeholder="Email Address" required="">
					</div>
					<div class="form-group-2 mb-4">
						<textarea name="message" class="form-control" rows="4" placeholder="Your Message" required=""></textarea>
					</div>
					<button class="btn btn-main" name="submit" type="submit">Send Message</button>
				</form>
			</div>

			{{-- <div class="col-lg-5 col-sm-12">
				<div class="contact-content pl-lg-5 mt-5 mt-lg-0">
					<span class="text-muted">Expertise You Can Trust</span>
					<h2 class="mb-5 mt-2">Feel free to reach out for any inquiries or information.</h2>

					<ul class="address-block list-unstyled">
						<li>
							<i class="ti-direction mr-3"></i>North Main Street,Brooklyn Australia
						</li>
						<li>
							<i class="ti-email mr-3"></i>Email: contact@mail.com
						</li>
						<li>
							<i class="ti-mobile mr-3"></i>Phone:+88 01672 506 744
						</li>
					</ul>
				</div>
			</div> --}}
		</div>
	</div>
</section>
@endsection
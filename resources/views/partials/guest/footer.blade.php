<footer class="footer section">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
          <div class="widget">
            <h4 class="text-capitalize mb-4">Quick Links</h4>
  
            <ul class="list-unstyled footer-menu lh-35">
              <li><a href="{{ route('about') }}">About</a></li>
              <li><a href="{{ route('service') }}">Services</a></li>
              <li><a href="{{ route('our.properties') }}">Our Properties</a></li>
              <li><a href="{{ route('contact') }}">Contact</a></li>
            </ul>
          </div>
        </div>
  
        <div class="col-lg-6 col-sm-6 d-flex justify-content-end">
          <div class="widget">
            <div class="logo mb-4">
              <h3>Fresh<span>Factory.</span></h3>
            </div>
            <h6><a href="mailto:{{ config('mail.mailers.smtp.username') }}">Need Support? Mail Here!</a></h6>
          </div>
        </div>
      </div>
  
    </div>
</footer>
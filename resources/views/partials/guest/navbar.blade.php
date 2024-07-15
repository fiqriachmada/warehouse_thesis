<header class="navigation">
    <div id="navbar">
      <div class="container">
        <div class="row">
          <div class="col-lg-12">
            <nav class="navbar navbar-expand-lg px-0 py-4">
        
              <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample09"
                aria-controls="navbarsExample09" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span>
              </button>
        
              <div class="collapse navbar-collapse justify-content-center" id="navbarsExample09">
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
                    <a class="nav-link" href="/">Home</a>
                  </li>
                  <li class="nav-item {{ Request::is('about-us') ? 'active' : '' }}"><a class="nav-link" href="{{ route('about') }}">About Us</a></li>
                  <li class="nav-item {{ Request::is('service') ? 'active' : '' }} "><a class="nav-link" href="{{ route('service') }}">Services</a></li>
                  <li class="nav-item {{ Request::is('our-properties') ? 'active' : '' }}"><a class="nav-link" href="{{ route('our.properties') }}">Our Properties</a></li>
                  <li class="nav-item {{ Request::is('contact-us') ? 'active' : '' }}"><a class="nav-link" href="{{ route('contact') }}">Contact</a></li>
                </ul>
        
                <div class="my-2 my-md-0 ml-lg-4 text-center ms-2">
                  <a href="{{ route('login.user') }}" class="btn btn-solid-border btn-round-full">Sign In</a>
                </div>
              </div>
            </nav>
          </div>
        </div>
      </div>
    </div>
  </header>
  
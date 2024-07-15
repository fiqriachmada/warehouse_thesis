<div class="row">
    <div class="col-xl-4 col-lg-5 col-md-5">
      <!-- About User -->
      <div class="card mb-4">
        <div class="card-body">
          <small class="card-text text-uppercase">About</small>
          <ul class="list-unstyled mb-4 mt-3">
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-user"></i><span class="fw-bold mx-2">Full Name:</span> <span>{{ auth()->user()->tenant->name }}</span>
            </li>
            <li class="d-flex align-items-center mb-3 text-capitalize">
              <i class="ti ti-check"></i><span class="fw-bold mx-2">Status:</span> <span>{{ auth()->user()->tenant->status }}</span>
            </li>
            {{-- <li class="d-flex align-items-center mb-3">
              <i class="ti ti-flag"></i><span class="fw-bold mx-2">Place, Date of Birth:</span> <span>{{ auth()->user()->tenant->pob }}, {{ \Carbon\Carbon::parse(auth()->user()->tenant->dob)->format('d/m/Y') }}</span>
            </li> --}}
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-pin"></i><span class="fw-bold mx-2">Address:</span>
              <span>{{ auth()->user()->tenant->address }}</span>
            </li>
          </ul>
          <small class="card-text text-uppercase">Contacts</small>
          <ul class="list-unstyled mb-4 mt-3">
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-phone-call"></i><span class="fw-bold mx-2">Contact:</span>
              <span>{{ auth()->user()->tenant->phone }}</span>
            </li>
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-mail"></i><span class="fw-bold mx-2">Email:</span>
              <span>{{ auth()->user()->tenant->email }}</span>
            </li>
          </ul>
          {{-- <small class="card-text text-uppercase">Teams</small>
          <ul class="list-unstyled mb-0 mt-3">
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-brand-angular text-danger me-2"></i>
              <div class="d-flex flex-wrap">
                <span class="fw-bold me-2">Backend Developer</span><span>(126 Members)</span>
              </div>
            </li>
            <li class="d-flex align-items-center">
              <i class="ti ti-brand-react-native text-info me-2"></i>
              <div class="d-flex flex-wrap">
                <span class="fw-bold me-2">React Developer</span><span>(98 Members)</span>
              </div>
            </li>
          </ul> --}}
        </div>
      </div>

      <div class="card mb-4">
        <div class="card-body">
          <p class="card-text text-uppercase">Overview</p>
          <ul class="list-unstyled mb-0">
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-check"></i><span class="fw-bold mx-2">Task Compiled:</span> <span>13.5k</span>
            </li>
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-layout-grid"></i><span class="fw-bold mx-2">Projects Compiled:</span>
              <span>146</span>
            </li>
            <li class="d-flex align-items-center">
              <i class="ti ti-users"></i><span class="fw-bold mx-2">Connections:</span> <span>897</span>
            </li>
          </ul>
        </div>
      </div>
      
    </div>
</div>
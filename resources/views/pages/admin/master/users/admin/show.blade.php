@extends('layouts.admin')

@section('title')
    Master - Detail Admin
@endsection

@section('section-admin')
<div id="attribute" data-attribute="{{ auth()->user()->attribute }}"></div>
<div class="container-xxl flex-grow-1 container-p-y">
  <div class="row">
    <!-- User Sidebar -->
    <div class="col-xl-4 col-lg-5 col-md-5 order-1 order-md-0">
      <!-- User Card -->
      <div class="card mb-4">
        <div class="card-body">
          <div class="user-avatar-section">
            <div class="d-flex align-items-center flex-column">
              @if ($admin->getFirstMediaUrl('admin_images'))
                    <img
                        class="img-fluid rounded mb-3 pt-1 mt-4"
                        src="{{ $admin->getFirstMediaUrl('admin_images') }}"
                        height="100"
                        width="100"
                        alt="{{ $admin->id }}" />
                @else
                    <img
                        class="img-fluid rounded mb-3 pt-1 mt-4"
                        src="{{ asset('assets/img/avatars/1.png') }}"
                        height="100"
                        width="100"
                        alt="{{ $admin->id }}" />
                @endif
              <div class="user-info text-center">
                <h4 class="mb-2">{{ $admin->name }}</h4>
                <span class="badge bg-label-secondary mt-1 text-capitalize">{{ $admin->user->level }}</span>
              </div>
            </div>
          </div>
          {{-- <div class="d-flex justify-content-around flex-wrap mt-3 pt-3 pb-4 border-bottom">
            <div class="d-flex align-items-start me-4 mt-3 gap-2">
              <span class="badge bg-label-primary p-2 rounded"><i class="ti ti-checkbox ti-sm"></i></span>
              <div>
                <p class="mb-0 fw-semibold">1.23k</p>
                <small>Tasks Done</small>
              </div>
            </div>
            <div class="d-flex align-items-start mt-3 gap-2">
              <span class="badge bg-label-primary p-2 rounded"><i class="ti ti-briefcase ti-sm"></i></span>
              <div>
                <p class="mb-0 fw-semibold">568</p>
                <small>Projects Done</small>
              </div>
            </div>
          </div> --}}
          <p class="mt-4 small text-uppercase text-muted">Details</p>
          <div class="info-container">
            <ul class="list-unstyled">
              <li class="mb-2">
                <span class="fw-semibold me-1">Username:</span>
                <span>{{ $admin->user->username }}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Email:</span>
                <span>{{ $admin->email }}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Status:</span>
                <span class="badge bg-label-{{ $admin->status == 'active' ? 'success' : 'danger' }}">{{ $admin->status }}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Role:</span>
                <span class="text-capitalize">{{ $admin->user->level }}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Contact:</span>
                <span>{{ $admin->phone }}</span>
              </li>
              <li class="mb-2 pt-1">
                <span class="fw-semibold me-1">Place, Date Of Birth:</span>
                <span class="text-capitalize">{{ $admin->pob }}, {{ \Carbon\Carbon::parse($admin->dob)->format('d/m/Y') }}</span>
              </li>
              <li class="pt-1">
                <span class="fw-semibold me-1">Address:</span>
                <span>{{ $admin->address }}</span>
              </li>
            </ul>
            @if (auth()->user()->attribute == 'core')
            <div class="d-flex justify-content-center">
              <a href="javascript:;" class="btn btn-primary me-3 waves-effect waves-light" data-bs-target="#editAdmin" data-bs-toggle="modal" id="button-trigger-modal-edit-admin" data-id="{{ $admin->user_id }}">Edit</a>
              <form action="{{ route('master.admin.update.status', $admin->id) }}" method="post">
                @csrf
                @method('PATCH')
                <button type="submit" class="btn btn-label-{{ $admin->status == 'active' ? 'danger' : 'success' }} suspend-user waves-effect">{{ $admin->status == 'active' ? 'Suspended' : 'Actived' }}</button>
              </form>
            </div>
            @endif
          </div>
        </div>
      </div>
      <!-- /User Card -->
    </div>
    <!--/ User Sidebar -->

    <div class="col-xl-8 col-lg-7 col-md-7 order-0 order-md-1">
      <ul class="nav nav-pills flex-column flex-md-row mb-4">
        <li class="nav-item">
          <a class="nav-link nav-link-admin active" href="javascript:void(0);" id="account" data-id="{{ $admin->id }}"><i class="ti ti-user-check ti-xs me-1"></i>Account</a>
        </li>
        <li class="nav-item">
          <a class="nav-link nav-link-admin" href="javascript:void(0);" id="security" data-id="{{ $admin->id }}"><i class="ti ti-lock ti-xs me-1"></i>Security</a>
        </li>
      </ul>

      <div id="data-admin-detail"></div>
    </div>
  </div>
</div>
@endsection
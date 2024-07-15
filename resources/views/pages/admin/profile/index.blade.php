@extends('layouts.admin')

@section('title')
    Profil - Admin
@endsection

@section('section-admin')
<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="user-profile-header-banner">
            <img src="{{ asset('assets/img/pages/profile-banner.png') }}" alt="Banner image" class="rounded-top">
          </div>
          <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-start text-center mb-4">
            <div class="flex-shrink-0 mt-n2 mx-sm-0 mx-auto">
                @if (auth()->user()->admin->getFirstMediaUrl('admin_images'))
                    <img src="{{ auth()->user()->admin->getFirstMediaUrl('admin_images') }}" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
                @else 
                    <img src="{{ asset('assets/img/avatars/14.png') }}" alt="user image" class="d-block h-auto ms-0 ms-sm-4 rounded user-profile-img">
                @endif
            </div>
            <div class="flex-grow-1 mt-3 mt-sm-5">
              <div class="d-flex align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                <div class="user-profile-info">
                  <h4 class="text-capitalize">{{ auth()->user()->admin->name }}</h4>
                  <ul class="list-inline mb-0 d-flex align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                    <li class="list-inline-item text-capitalize"><i class="ti ti-color-swatch"></i> {{ auth()->user()->level }}</li>
                    <li class="list-inline-item"><i class="ti ti-calendar"></i> Joined {{ \Carbon\Carbon::parse(auth()->user()->created_at)->format('F Y') }}</li>
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-sm-row mb-4">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/profile') ? 'active' : '' }}" href="{{ route('admin.profile') }}"><i class="ti-xs ti ti-user-check me-1"></i> Profile</a>
          </li>
          @if (auth()->user()->attribute == 'core')
          <li class="nav-item">
            <a class="nav-link {{ Request::is('admin/teams') ? 'active' : '' }}" href="{{ route('admin.teams') }}"><i class="ti-xs ti ti-users me-1"></i> Teams</a>
          </li>
          @endif
        </ul>
      </div>
    </div>

    @if (Request::is('admin/profile'))
      @include('pages.admin.profile.profile')
    @elseif (auth()->user()->attribute == 'core' && Request::is('admin/teams'))
      @include('pages.admin.profile.teams')
    @endif
</div>
@endsection
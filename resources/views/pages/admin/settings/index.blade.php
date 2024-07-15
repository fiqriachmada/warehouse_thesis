@extends('layouts.admin')

@section('title')
    Settings - Admin
@endsection

@section('section-admin')
<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row fv-plugins-icon-container">
      <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-md-row mb-4">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('settings/admin-profile') ? 'active' : '' }}" href="{{ route('admin.settings.profile') }}"><i class="ti-xs ti ti-users me-1"></i> Account</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('settings/admin-password') ? 'active' : '' }}" href="{{ route('admin.settings.password') }}"><i class="ti-xs ti ti-lock me-1"></i> Security</a>
          </li>
        </ul>

        @if (Request::is('settings/admin-profile'))
          @include('pages.admin.settings.profile.index')
        @elseif (Request::is('settings/admin-password'))
          @include('pages.admin.settings.password.index')
        @elseif (Request::is('settings/billing'))
          @include('pages.admin.settings.billing.index')
        @endif
        
      </div>
    </div>
</div>
@endsection
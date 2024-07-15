@extends('layouts.tenant')

@section('title')
    Settings - Tenant
@endsection

@section('section-tenant')
<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row fv-plugins-icon-container">
      <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-md-row mb-4">
          <li class="nav-item">
            <a class="nav-link {{ Request::is('settings/tenant-profile') ? 'active' : '' }}" href="{{ route('tenant.settings.profile') }}"><i class="ti-xs ti ti-users me-1"></i> Account</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ Request::is('settings/tenant-password') ? 'active' : '' }}" href="{{ route('tenant.settings.password') }}"><i class="ti-xs ti ti-lock me-1"></i> Security</a>
          </li>
        </ul>

        @if (Request::is('settings/tenant-profile'))
          @include('pages.tenant.settings.profile.index')
        @elseif (Request::is('settings/tenant-password'))
          @include('pages.tenant.settings.password.index')
        @endif
        
      </div>
    </div>
</div>
@endsection
@extends('layouts.tenant')

@section('title')
    Transaction - List
@endsection

@section('section-tenant')
<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row">
      <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-sm-row mb-4">
          <li class="nav-item">
            <a class="nav-link {{ $status === 'payment' ? 'active' : '' }}" href="{{ route('tenant.transaction.index', 'payment') }}"><i class="ti ti-wallet me-1 ti-xs"></i> Payment</a>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link {{ $status === 'success' ? 'active' : '' }}" href="{{ route('tenant.transaction.index', 'success') }}"><i class="ti ti-alert-octagon me-1 ti-xs"></i> Pending</a>
          </li> --}}
          <li class="nav-item">
            <a class="nav-link {{ $status === 'confirmed' ? 'active' : '' }}" href="{{ route('tenant.transaction.index', 'confirmed') }}"><i class="ti ti-check me-1 ti-xs"></i> Confirmed</a>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link {{ $status === 'declined' ? 'active' : '' }}" href="{{ route('tenant.transaction.index', 'declined') }}"><i class="ti ti-x me-1 ti-xs"></i> Declined</a>
          </li> --}}
        </ul>
      </div>
    </div>

    @if ($status === 'payment')
        @include('pages.tenant.transaction.payment.index')
    {{-- @elseif ($status === 'success')
        @include('pages.tenant.transaction.pending.index') --}}
    @elseif ($status === 'confirmed')
        @include('pages.tenant.transaction.confirmed.index')
    {{-- @elseif ($status === 'declined')
        @include('pages.tenant.transaction.declined.index') --}}
    @endif
</div>
@endsection
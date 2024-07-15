@extends('layouts.admin')

@section('title')
    Purchase - List Purchase
@endsection

@section('section-admin')
<div class="container-xxl flex-grow-1 container-p-y">

    <div class="row">
      <div class="col-md-12">
        <ul class="nav nav-pills flex-column flex-sm-row mb-4">
          <li class="nav-item">
            <a class="nav-link {{ $status === 'payment' ? 'active' : '' }}" href="{{ route('purchase.index', 'payment') }}"><i class="ti ti-wallet me-1 ti-xs"></i> Payment</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ $status === 'confirmed' ? 'active' : '' }}" href="{{ route('purchase.index', 'confirmed') }}"><i class="ti ti-check me-1 ti-xs"></i> Confirmed</a>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link {{ $status === 'declined' ? 'active' : '' }}" href="{{ route('purchase.index', 'declined') }}"><i class="ti ti-x me-1 ti-xs"></i> Declined</a>
          </li> --}}
        </ul>
      </div>
    </div>

    @if ($status === 'payment')
        @include('pages.admin.purchase.pending.index')
    @elseif ($status === 'confirmed')
        @include('pages.admin.purchase.confirmed.index')
    {{-- @elseif ($status === 'declined')
        @include('pages.admin.purchase.declined.index') --}}
    @endif
</div>
@endsection
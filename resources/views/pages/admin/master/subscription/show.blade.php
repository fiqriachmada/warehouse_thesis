@extends('layouts.admin')

@section('title')
    Master - Detail Subscription
@endsection

@section('section-admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-3">Detail Subscription - {{ $subscription->name }}</h5>
      </div>
      <div class="card-datatable table-responsive">
        <table class="table border-top" id="listDetailSubscriptionsTable" data-id="{{ $subscription->id }}">
          <thead>
            <tr>
              <th></th>
              <th class="text-center">No</th>
              <th class="text-center">Warehouse</th>
              <th class="text-center">Tenant</th>
              <th class="text-center">Remaining Time</th>
              <th class="text-center">Start Date</th>
              <th class="text-center">End Date</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
</div>
@endsection
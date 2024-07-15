@extends('layouts.tenant')

@section('title')
    Reporting - History - Rent
@endsection

@section('section-tenant')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-3">Rent History - {{ $warehouse->name }}</h5>
      </div>
      <div class="card-datatable table-responsive">
        <table class="table border-top" id="listRentHistoryTenantTable" data-id="{{ $warehouse->id }}">
          <thead>
            <tr>
              <th></th>
              <th class="text-center">No</th>
              <th class="text-center">Subscription</th>
              <th class="text-center">Started At</th>
              <th class="text-center">Ended At</th>
              <th class="text-center">Price</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
</div>
@endsection
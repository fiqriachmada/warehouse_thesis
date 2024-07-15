@extends('layouts.warehouse')

@section('title')
    Outbound - List
@endsection

@section('section-warehouse')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-3">List Outbound</h5>
      </div>
      <div class="card-datatable table-responsive">
        <table class="table border-top" id="listWarehouseOutboundsTable" data-id="{{ $warehouse->id }}">
          <thead>
            <tr>
              <th></th>
              <th class="text-center">No</th>
              <th class="text-center">Order ID</th>
              <th class="text-center">Customer</th>
              <th class="text-center">Date Issue</th>
              <th class="text-center">Amount Total</th>
              <th class="text-center">Grand Total</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
        </table>
      </div>

    </div>
</div>
@endsection
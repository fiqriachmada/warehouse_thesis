@extends('layouts.warehouse')

@section('title')
    Reporting - Performance - Supplier
@endsection

@section('section-warehouse')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-3">Supplier Performance</h5>
      </div>
      <div class="card-datatable table-responsive">
        <table class="table border-top" id="listSupplierPerformanceWarehouseTable" data-id="{{ $warehouse->id }}">
          <thead>
            <tr>
              <th></th>
              <th class="text-center">No</th>
              <th class="text-center">Supplier</th>
              <th class="text-center">Stock Sent</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
</div>
@endsection
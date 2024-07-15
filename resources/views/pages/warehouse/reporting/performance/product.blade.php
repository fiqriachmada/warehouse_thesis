@extends('layouts.warehouse')

@section('title')
    Reporting - Performance - Product
@endsection

@section('section-warehouse')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-3">Product Performance</h5>
      </div>
      <div class="card-datatable table-responsive">
        <table class="table border-top" id="listProductPerformanceWarehouseTable" data-id="{{ $warehouse->id }}">
          <thead>
            <tr>
              <th></th>
              <th class="text-center">No</th>
              <th class="text-center">Product</th>
              <th class="text-center">Stock Sold</th>
              <th class="text-center">Income</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
</div>
@endsection
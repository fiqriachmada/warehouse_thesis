@extends('layouts.warehouse')

@section('title')
    Inbound - List
@endsection

@section('section-warehouse')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-3">List Inbound</h5>
      </div>
      <div class="card-datatable table-responsive">
        <table class="table border-top" id="listWarehouseInboundsTable" data-id="{{ $warehouse->id }}">
          <thead>
            <tr>
              <th></th>
              <th class="text-center">No</th>
              <th class="text-center">Code</th>
              <th class="text-center">Supplier</th>
              <th class="text-center">Product</th>
              <th class="text-center">Price</th>
              <th class="text-center">On Hand</th>
              <th class="text-center">Received At</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
        </table>
      </div>

    </div>
</div>
@endsection
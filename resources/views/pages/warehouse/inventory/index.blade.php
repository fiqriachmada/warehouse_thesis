@extends('layouts.warehouse')

@section('title')
    Inventory - List
@endsection

@section('section-warehouse')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-3">Inventories</h5>
      </div>
      <div class="card-datatable table-responsive">
        <table class="table border-top" id="listWarehouseInventoriesTable" data-id="{{ $warehouse->id }}">
          <thead>
            <tr>
              <th></th>
              <th class="text-center">No</th>
              <th class="text-center">Product</th>
              <th class="text-center">Category</th>
              <th class="text-center">Rack</th>
              <th class="text-center">Actual Stock</th>
              <th class="text-center">On Hand</th>
              <th class="text-center">Sale Price</th>
            </tr>
          </thead>
        </table>
      </div>

    </div>
</div>
@endsection
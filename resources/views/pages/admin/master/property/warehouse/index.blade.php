@extends('layouts.admin')

@section('title')
    Master - List Warehouse
@endsection

@section('section-admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-3">List Warehouses</h5>
      </div>
      <div class="card-datatable table-responsive">
        <table class="table border-top" id="listWarehousesTable" data-type="show">
          <thead>
            <tr>
              <th></th>
              <th class="text-center">No</th>
              <th class="text-center">Warehouse</th>
              <th class="text-center">Category</th>
              <th class="text-center">Capacity</th>
              <th class="text-center">Surface Area</th>
              <th class="text-center">Building Area</th>
              <th class="text-center">Country</th>
              <th class="text-center">Zip Code</th>
              <th class="text-center">City</th>
              <th class="text-center">Address</th>
              <th class="text-center">Storage Shelves</th>
              <th class="text-center">Goods Handling Equipment</th>
              <th class="text-center">Effective Lighting System</th>
              <th class="text-center">Advanced Security System</th>
              <th class="text-center">Toilet and Rest Area</th>
              <th class="text-center">Electricity</th>
              <th class="text-center">Administrative Room or Office</th>
              <th class="text-center">Worker Safety Equipment</th>
              <th class="text-center">Firefighting Tools</th>
              <th class="text-center">Description</th>
              <th class="text-center">Registered By</th>
              <th class="text-center">Registered At</th>
              <th class="text-center">Status</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
</div>
@endsection
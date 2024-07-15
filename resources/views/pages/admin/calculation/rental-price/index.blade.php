@extends('layouts.admin')

@section('title')
    Calculation - List Rental Price
@endsection

@section('section-admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-3">List Rental Price Calculation</h5>
      </div>
      <div class="card-datatable table-responsive">
        <table class="table border-top" id="listRentalPriceCalculationsTable">
          <thead>
            <tr>
              <th></th>
              <th class="text-center">No</th>
              <th class="text-center">Warehouse</th>
              <th class="text-center">Subscription</th>
              <th class="text-center">Month Duration</th>
              <th class="text-center">Price Rate</th>
              <th class="text-center">Total Price</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
</div>
@endsection
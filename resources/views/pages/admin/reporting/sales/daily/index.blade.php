@extends('layouts.admin')

@section('title')
    Reporting - Sales - Daily
@endsection

@section('section-admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-3">List Daily Sales</h5>
      </div>
      <div class="card-datatable table-responsive">
        <table class="table border-top" id="listDailySalesReportTable">
          <thead>
            <tr>
              <th></th>
              <th class="text-center">No</th>
              <th class="text-center">Date Issued</th>
              <th class="text-center">Amount</th>
              <th class="text-center">Grand Total</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
        </table>
      </div>
    </div>
</div>
@endsection
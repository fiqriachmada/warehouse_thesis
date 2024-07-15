<div class="card-datatable table-responsive">
    <table class="table border-top" id="listCustomerPerformanceReportTable" data-id="{{ $customer->id }}">
      <thead>
        <tr>
          <th></th>
          <th class="text-center">No</th>
          <th class="text-center">Customer</th>
          <th class="text-center">Date Issue</th>
          <th class="text-center">Tot. Product Buy</th>
          <th class="text-center">Total Spend</th>
        </tr>
      </thead>
    </table>
</div>

<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
<script src="{{ asset('assets/js/app-detail-customer-performance-tenant.js') }}"></script>
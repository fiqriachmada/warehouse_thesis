<div class="card-datatable table-responsive">
    <table class="table border-top" id="listSupplierPerformanceReportTable" data-id="{{ $supplier->id }}">
      <thead>
        <tr>
          <th></th>
          <th class="text-center">No</th>
          <th class="text-center">Supplier</th>
          <th class="text-center">Product</th>
          <th class="text-center">Arrival Date</th>
          <th class="text-center">On Hand</th>
        </tr>
      </thead>
    </table>
</div>

<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
<script src="{{ asset('assets/js/app-detail-supplier-performance-tenant.js') }}"></script>
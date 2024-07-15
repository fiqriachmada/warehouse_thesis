<div class="card-datatable table-responsive">
    <table class="table border-top" id="listProductPerformanceReportTable" data-id="{{ $product->id }}">
      <thead>
        <tr>
          <th></th>
          <th class="text-center">No</th>
          <th class="text-center">Product</th>
          <th class="text-center">Sale Date</th>
          <th class="text-center">Quantity</th>
          <th class="text-center">Subtotal</th>
        </tr>
      </thead>
    </table>
</div>

<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
<script src="{{ asset('assets/js/app-detail-product-performance-warehouse.js') }}"></script>
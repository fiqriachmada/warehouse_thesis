<div class="card">
    <div class="card-header border-bottom">
    <h5 class="card-title mb-3">Rental Activity</h5>
    </div>
    <div class="card-datatable table-responsive">
    <table class="table border-top" id="listRentalActivityTable" data-id="{{ $warehouse->id }}">
        <thead>
        <tr>
            <th></th>
            <th class="text-center">No</th>
            <th class="text-center">Tenant</th>
            <th class="text-center">Date</th>
            <th class="text-center">Subscription</th>
            {{-- <th class="text-center">Bank</th> --}}
            <th class="text-center">Total</th>
            <th class="text-center">Action</th>
        </tr>
        </thead>
    </table>
    </div>
</div>

<script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
<script src="{{ asset('assets/js/app-rental-activity-list.js') }}"></script>
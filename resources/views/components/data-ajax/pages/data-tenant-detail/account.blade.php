<div class="card mb-4">
    <h5 class="card-header pb-0">Change Tenant Image</h5>
    <form action="{{ route('master.tenant.update.image', $tenant->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="card-body">
            <label for="tenant_image">Tenant Image</label>
            <input type="file" name="tenant_image" id="image" class="form-control" required>
            <button class="btn btn-primary mt-3" type="submit" id="button-submit-image-change">Change</button>
        </div>
    </form>
</div>

{{-- <div class="card mb-4">
    <h5 class="card-header">User's Projects List</h5>
    <div class="table-responsive mb-3">
    <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="d-flex justify-content-between align-items-center flex-column flex-sm-row mx-4 row"><div class="col-sm-4 col-12 d-flex align-items-center justify-content-sm-start justify-content-center"><div class="dataTables_length" id="DataTables_Table_0_length"><label>Show <select name="DataTables_Table_0_length" aria-controls="DataTables_Table_0" class="form-select"><option value="7">7</option><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="75">75</option><option value="100">100</option></select></label></div></div><div class="col-sm-8 col-12 d-flex align-items-center justify-content-sm-end justify-content-center"><div id="DataTables_Table_0_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control" placeholder="Search Project" aria-controls="DataTables_Table_0"></label></div></div></div><table class="table datatable-project border-top dataTable no-footer dtr-column" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
        <thead>
        <tr><th class="control sorting dtr-hidden" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 38.4688px; display: none;" aria-label=": activate to sort column ascending"></th><th class="sorting sorting_desc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 155.797px;" aria-sort="descending" aria-label="Project: activate to sort column ascending">Project</th><th class="text-nowrap sorting_disabled" rowspan="1" colspan="1" style="width: 195.281px;" aria-label="Total Task">Total Task</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 184.516px;" aria-label="Progress: activate to sort column ascending">Progress</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 127.938px;" aria-label="Hours">Hours</th></tr>
        </thead><tbody><tr class="odd"><td valign="top" colspan="4" class="dataTables_empty">Loading...</td></tr></tbody>
    </table><div class="d-flex justify-content-between mx-4 row"><div class="col-sm-12 col-md-6"><div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 0 to 0 of 0 entries</div></div><div class="col-sm-12 col-md-6"><div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous"><a aria-controls="DataTables_Table_0" aria-disabled="true" aria-role="link" data-dt-idx="previous" tabindex="0" class="page-link waves-effect">Previous</a></li><li class="paginate_button page-item next disabled" id="DataTables_Table_0_next"><a aria-controls="DataTables_Table_0" aria-disabled="true" aria-role="link" data-dt-idx="next" tabindex="0" class="page-link waves-effect">Next</a></li></ul></div></div></div></div>
    </div>
</div>
<!-- /Project table -->

<!-- Activity Timeline -->
<div class="card mb-4">
    <h5 class="card-header">User Activity Timeline</h5>
    <div class="card-body pb-0">
    <ul class="timeline mb-0">
        <li class="timeline-item timeline-item-transparent">
        <span class="timeline-point timeline-point-primary"></span>
        <div class="timeline-event">
            <div class="timeline-header mb-1">
            <h6 class="mb-0">12 Invoices have been paid</h6>
            <small class="text-muted">12 min ago</small>
            </div>
            <p class="mb-2">Invoices have been paid to the company</p>
            <div class="d-flex">
            <a href="javascript:void(0)" class="me-3">
                <img src="../../assets/img/icons/misc/pdf.png" alt="PDF image" width="15" class="me-2">
                <span class="fw-semibold text-heading">invoices.pdf</span>
            </a>
            </div>
        </div>
        </li>
        <li class="timeline-item timeline-item-transparent">
        <span class="timeline-point timeline-point-warning"></span>
        <div class="timeline-event">
            <div class="timeline-header mb-1">
            <h6 class="mb-0">Client Meeting</h6>
            <small class="text-muted">45 min ago</small>
            </div>
            <p class="mb-2">Project meeting with john @10:15am</p>
            <div class="d-flex flex-wrap">
            <div class="avatar me-3">
                <img src="../../assets/img/avatars/3.png" alt="Avatar" class="rounded-circle">
            </div>
            <div>
                <h6 class="mb-0">Lester McCarthy (Client)</h6>
                <small>CEO of Pixinvent</small>
            </div>
            </div>
        </div>
        </li>
        <li class="timeline-item timeline-item-transparent">
        <span class="timeline-point timeline-point-info"></span>
        <div class="timeline-event">
            <div class="timeline-header mb-1">
            <h6 class="mb-0">Create a new project for client</h6>
            <small class="text-muted">2 Day Ago</small>
            </div>
            <p class="mb-2">5 team members in a project</p>
            <div class="d-flex align-items-center avatar-group">
            <div class="avatar pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" aria-label="Vinnie Mostowy" data-bs-original-title="Vinnie Mostowy">
                <img src="../../assets/img/avatars/5.png" alt="Avatar" class="rounded-circle">
            </div>
            <div class="avatar pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" aria-label="Marrie Patty" data-bs-original-title="Marrie Patty">
                <img src="../../assets/img/avatars/12.png" alt="Avatar" class="rounded-circle">
            </div>
            <div class="avatar pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" aria-label="Jimmy Jackson" data-bs-original-title="Jimmy Jackson">
                <img src="../../assets/img/avatars/9.png" alt="Avatar" class="rounded-circle">
            </div>
            <div class="avatar pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" aria-label="Kristine Gill" data-bs-original-title="Kristine Gill">
                <img src="../../assets/img/avatars/6.png" alt="Avatar" class="rounded-circle">
            </div>
            <div class="avatar pull-up" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="top" aria-label="Nelson Wilson" data-bs-original-title="Nelson Wilson">
                <img src="../../assets/img/avatars/4.png" alt="Avatar" class="rounded-circle">
            </div>
            </div>
        </div>
        </li>
        <li class="timeline-item timeline-item-transparent border-0">
        <span class="timeline-point timeline-point-success"></span>
        <div class="timeline-event">
            <div class="timeline-header mb-1">
            <h6 class="mb-0">Design Review</h6>
            <small class="text-muted">5 days Ago</small>
            </div>
            <p class="mb-0">Weekly review of freshly prepared design for our new app.</p>
        </div>
        </li>
    </ul>
    </div>
</div>
<!-- /Activity Timeline -->

<!-- Invoice table -->
<div class="card mb-4">
    <div class="table-responsive mb-3">
    <div id="DataTables_Table_1_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="row mx-4"><div class="col-sm-6 col-12 d-flex align-items-center justify-content-center justify-content-sm-start mb-3 mb-md-0"><div class="dataTables_length" id="DataTables_Table_1_length"><label>Show <select name="DataTables_Table_1_length" aria-controls="DataTables_Table_1" class="form-select"><option value="10">10</option><option value="25">25</option><option value="50">50</option><option value="100">100</option></select></label></div></div><div class="col-sm-6 col-12 d-flex align-items-center justify-content-center justify-content-sm-end"><div class="dt-buttons btn-group flex-wrap"><div class="btn-group"><button class="btn btn-secondary buttons-collection dropdown-toggle btn-label-secondary float-sm-end mb-3 mb-sm-0 waves-effect" tabindex="0" aria-controls="DataTables_Table_1" type="button" aria-haspopup="dialog" aria-expanded="false"><span><i class="ti ti-screen-share ti-xs me-2"></i>Export</span><span class="dt-down-arrow"></span></button></div> </div></div></div><table class="table datatable-invoice border-top dataTable no-footer dtr-column" id="DataTables_Table_1" aria-describedby="DataTables_Table_1_info">
        <thead>
        <tr><th class="control sorting dtr-hidden" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 36.4531px; display: none;" aria-label=": activate to sort column ascending"></th><th class="sorting sorting_desc" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 63.4531px;" aria-sort="descending" aria-label="ID: activate to sort column ascending">ID</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 74.4531px;" aria-label=": activate to sort column ascending"><i class="ti ti-trending-up"></i></th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 119.359px;" aria-label="Total: activate to sort column ascending">Total</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_1" rowspan="1" colspan="1" style="width: 207.672px;" aria-label="Issued Date: activate to sort column ascending">Issued Date</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 148.609px;" aria-label="Actions">Actions</th></tr>
        </thead><tbody><tr class="odd"><td valign="top" colspan="5" class="dataTables_empty">Loading...</td></tr></tbody>
    </table><div class="row mx-4"><div class="col-md-12 col-lg-6 text-center text-lg-start pb-md-2 pb-lg-0"><div class="dataTables_info" id="DataTables_Table_1_info" role="status" aria-live="polite">Showing 0 to 0 of 0 entries</div></div><div class="col-md-12 col-lg-6 d-flex justify-content-center justify-content-lg-end"><div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_1_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="DataTables_Table_1_previous"><a aria-controls="DataTables_Table_1" aria-disabled="true" aria-role="link" data-dt-idx="previous" tabindex="0" class="page-link waves-effect">Previous</a></li><li class="paginate_button page-item next disabled" id="DataTables_Table_1_next"><a aria-controls="DataTables_Table_1" aria-disabled="true" aria-role="link" data-dt-idx="next" tabindex="0" class="page-link waves-effect">Next</a></li></ul></div></div></div></div>
    </div>
</div> --}}
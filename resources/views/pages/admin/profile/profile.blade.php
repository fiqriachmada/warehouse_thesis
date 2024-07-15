<div class="row">
    <div class="col-xl-4 col-lg-5 col-md-5">
      <!-- About User -->
      <div class="card mb-4">
        <div class="card-body">
          <small class="card-text text-uppercase">About</small>
          <ul class="list-unstyled mb-4 mt-3">
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-user"></i><span class="fw-bold mx-2">Full Name:</span> <span>{{ auth()->user()->admin->name }}</span>
            </li>
            <li class="d-flex align-items-center mb-3 text-capitalize">
              <i class="ti ti-check"></i><span class="fw-bold mx-2">Status:</span> <span>{{ auth()->user()->admin->status }}</span>
            </li>
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-flag"></i><span class="fw-bold mx-2">Place, Date of Birth:</span> <span>{{ auth()->user()->admin->pob }}, {{ \Carbon\Carbon::parse(auth()->user()->admin->dob)->format('d/m/Y') }}</span>
            </li>
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-pin"></i><span class="fw-bold mx-2">Address:</span>
              <span>{{ auth()->user()->admin->address }}</span>
            </li>
          </ul>
          <small class="card-text text-uppercase">Contacts</small>
          <ul class="list-unstyled mb-4 mt-3">
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-phone-call"></i><span class="fw-bold mx-2">Contact:</span>
              <span>{{ auth()->user()->admin->phone }}</span>
            </li>
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-mail"></i><span class="fw-bold mx-2">Email:</span>
              <span>{{ auth()->user()->admin->email }}</span>
            </li>
          </ul>
          {{-- <small class="card-text text-uppercase">Teams</small>
          <ul class="list-unstyled mb-0 mt-3">
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-brand-angular text-danger me-2"></i>
              <div class="d-flex flex-wrap">
                <span class="fw-bold me-2">Backend Developer</span><span>(126 Members)</span>
              </div>
            </li>
            <li class="d-flex align-items-center">
              <i class="ti ti-brand-react-native text-info me-2"></i>
              <div class="d-flex flex-wrap">
                <span class="fw-bold me-2">React Developer</span><span>(98 Members)</span>
              </div>
            </li>
          </ul> --}}
        </div>
      </div>

      {{-- <div class="card mb-4">
        <div class="card-body">
          <p class="card-text text-uppercase">Overview</p>
          <ul class="list-unstyled mb-0">
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-check"></i><span class="fw-bold mx-2">Task Compiled:</span> <span>13.5k</span>
            </li>
            <li class="d-flex align-items-center mb-3">
              <i class="ti ti-layout-grid"></i><span class="fw-bold mx-2">Projects Compiled:</span>
              <span>146</span>
            </li>
            <li class="d-flex align-items-center">
              <i class="ti ti-users"></i><span class="fw-bold mx-2">Connections:</span> <span>897</span>
            </li>
          </ul>
        </div>
      </div> --}}
      
    </div>
    <div class="col-xl-8 col-lg-7 col-md-7">
      <div class="card card-action mb-4">
        <div class="card-header align-items-center">
          <h5 class="card-action-title mb-0">Activity Timeline</h5>
          <div class="card-action-element">
            <div class="dropdown">
              <button type="button" class="btn dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="ti ti-dots-vertical text-muted"></i>
              </button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="javascript:void(0);">Share timeline</a></li>
                <li><a class="dropdown-item" href="javascript:void(0);">Suggest edits</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item" href="javascript:void(0);">Report bug</a></li>
              </ul>
            </div>
          </div>
        </div>
        <div class="card-body pb-0">
          <ul class="timeline ms-1 mb-0">
            <li class="timeline-item timeline-item-transparent">
              <span class="timeline-point timeline-point-primary"></span>
              <div class="timeline-event">
                <div class="timeline-header">
                  <h6 class="mb-0">Client Meeting</h6>
                  <small class="text-muted">Today</small>
                </div>
                <p class="mb-2">Project meeting with john @10:15am</p>
                <div class="d-flex flex-wrap">
                  <div class="avatar me-2">
                    <img src="../../assets/img/avatars/3.png" alt="Avatar" class="rounded-circle">
                  </div>
                  <div class="ms-1">
                    <h6 class="mb-0">Lester McCarthy (Client)</h6>
                    <span>CEO of Infibeam</span>
                  </div>
                </div>
              </div>
            </li>
            <li class="timeline-item timeline-item-transparent">
              <span class="timeline-point timeline-point-success"></span>
              <div class="timeline-event">
                <div class="timeline-header">
                  <h6 class="mb-0">Create a new project for client</h6>
                  <small class="text-muted">2 Day Ago</small>
                </div>
                <p class="mb-0">Add files to new design folder</p>
              </div>
            </li>
            <li class="timeline-item timeline-item-transparent">
              <span class="timeline-point timeline-point-danger"></span>
              <div class="timeline-event">
                <div class="timeline-header">
                  <h6 class="mb-0">Shared 2 New Project Files</h6>
                  <small class="text-muted">6 Day Ago</small>
                </div>
                <p class="mb-2">
                  Sent by Mollie Dixon
                  <img src="../../assets/img/avatars/4.png" class="rounded-circle me-3" alt="avatar" height="24" width="24">
                </p>
                <div class="d-flex flex-wrap gap-2 pt-1">
                  <a href="javascript:void(0)" class="me-3">
                    <img src="../../assets/img/icons/misc/doc.png" alt="Document image" width="15" class="me-2">
                    <span class="fw-semibold text-heading">App Guidelines</span>
                  </a>
                  <a href="javascript:void(0)">
                    <img src="../../assets/img/icons/misc/xls.png" alt="Excel image" width="15" class="me-2">
                    <span class="fw-semibold text-heading">Testing Results</span>
                  </a>
                </div>
              </div>
            </li>
            <li class="timeline-item timeline-item-transparent border-0">
              <span class="timeline-point timeline-point-info"></span>
              <div class="timeline-event">
                <div class="timeline-header">
                  <h6 class="mb-0">Project status updated</h6>
                  <small class="text-muted">10 Day Ago</small>
                </div>
                <p class="mb-0">Woocommerce iOS App Completed</p>
              </div>
            </li>
          </ul>
        </div>
      </div>

      <div class="row">
        <div class="col-lg-12 col-xl-6">
          <div class="card card-action mb-4">
            <div class="card-header align-items-center">
              <h5 class="card-action-title mb-0">Connections</h5>
              <div class="card-action-element">
                <div class="dropdown">
                  <button type="button" class="btn dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti ti-dots-vertical text-muted"></i>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="javascript:void(0);">Share connections</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);">Suggest edits</a></li>
                    <li>
                      <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="javascript:void(0);">Report bug</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
              <ul class="list-unstyled mb-0">
                <li class="mb-3">
                  <div class="d-flex align-items-start">
                    <div class="d-flex align-items-start">
                      <div class="avatar me-2">
                        <img src="../../assets/img/avatars/2.png" alt="Avatar" class="rounded-circle">
                      </div>
                      <div class="me-2 ms-1">
                        <h6 class="mb-0">Cecilia Payne</h6>
                        <small class="text-muted">45 Connections</small>
                      </div>
                    </div>
                    <div class="ms-auto">
                      <button class="btn btn-label-primary btn-icon btn-sm waves-effect">
                        <i class="ti ti-user-check ti-xs"></i>
                      </button>
                    </div>
                  </div>
                </li>
                <li class="mb-3">
                  <div class="d-flex align-items-start">
                    <div class="d-flex align-items-start">
                      <div class="avatar me-2">
                        <img src="../../assets/img/avatars/3.png" alt="Avatar" class="rounded-circle">
                      </div>
                      <div class="me-2 ms-1">
                        <h6 class="mb-0">Curtis Fletcher</h6>
                        <small class="text-muted">1.32k Connections</small>
                      </div>
                    </div>
                    <div class="ms-auto">
                      <button class="btn btn-primary btn-icon btn-sm waves-effect waves-light">
                        <i class="ti ti-user-x ti-xs"></i>
                      </button>
                    </div>
                  </div>
                </li>
                <li class="mb-3">
                  <div class="d-flex align-items-start">
                    <div class="d-flex align-items-start">
                      <div class="avatar me-2">
                        <img src="../../assets/img/avatars/10.png" alt="Avatar" class="rounded-circle">
                      </div>
                      <div class="me-2 ms-1">
                        <h6 class="mb-0">Alice Stone</h6>
                        <small class="text-muted">125 Connections</small>
                      </div>
                    </div>
                    <div class="ms-auto">
                      <button class="btn btn-primary btn-icon btn-sm waves-effect waves-light">
                        <i class="ti ti-user-x ti-xs"></i>
                      </button>
                    </div>
                  </div>
                </li>
                <li class="mb-3">
                  <div class="d-flex align-items-start">
                    <div class="d-flex align-items-start">
                      <div class="avatar me-2">
                        <img src="../../assets/img/avatars/7.png" alt="Avatar" class="rounded-circle">
                      </div>
                      <div class="me-2 ms-1">
                        <h6 class="mb-0">Darrell Barnes</h6>
                        <small class="text-muted">456 Connections</small>
                      </div>
                    </div>
                    <div class="ms-auto">
                      <button class="btn btn-label-primary btn-icon btn-sm waves-effect">
                        <i class="ti ti-user-check ti-xs"></i>
                      </button>
                    </div>
                  </div>
                </li>

                <li class="mb-3">
                  <div class="d-flex align-items-start">
                    <div class="d-flex align-items-start">
                      <div class="avatar me-2">
                        <img src="../../assets/img/avatars/12.png" alt="Avatar" class="rounded-circle">
                      </div>
                      <div class="me-2 ms-1">
                        <h6 class="mb-0">Eugenia Moore</h6>
                        <small class="text-muted">1.2k Connections</small>
                      </div>
                    </div>
                    <div class="ms-auto">
                      <button class="btn btn-label-primary btn-icon btn-sm waves-effect">
                        <i class="ti ti-user-check ti-xs"></i>
                      </button>
                    </div>
                  </div>
                </li>
                <li class="text-center">
                  <a href="javascript:;">View all connections</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!--/ Connections -->
        <!-- Teams -->
        <div class="col-lg-12 col-xl-6">
          <div class="card card-action mb-4">
            <div class="card-header align-items-center">
              <h5 class="card-action-title mb-0">Teams</h5>
              <div class="card-action-element">
                <div class="dropdown">
                  <button type="button" class="btn dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ti ti-dots-vertical text-muted"></i>
                  </button>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="javascript:void(0);">Share teams</a></li>
                    <li><a class="dropdown-item" href="javascript:void(0);">Suggest edits</a></li>
                    <li>
                      <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="javascript:void(0);">Report bug</a></li>
                  </ul>
                </div>
              </div>
            </div>
            <div class="card-body">
              <ul class="list-unstyled mb-0">
                <li class="mb-3">
                  <div class="d-flex align-items-center">
                    <div class="d-flex align-items-start">
                      <div class="avatar me-2">
                        <img src="../../assets/img/icons/brands/react-label.png" alt="Avatar" class="rounded-circle">
                      </div>
                      <div class="me-2 ms-1">
                        <h6 class="mb-0">React Developers</h6>
                        <small class="text-muted">72 Members</small>
                      </div>
                    </div>
                    <div class="ms-auto">
                      <a href="javascript:;"><span class="badge bg-label-danger">Developer</span></a>
                    </div>
                  </div>
                </li>
                <li class="mb-3">
                  <div class="d-flex align-items-center">
                    <div class="d-flex align-items-start">
                      <div class="avatar me-2">
                        <img src="../../assets/img/icons/brands/support-label.png" alt="Avatar" class="rounded-circle">
                      </div>
                      <div class="me-2 ms-1">
                        <h6 class="mb-0">Support Team</h6>
                        <small class="text-muted">122 Members</small>
                      </div>
                    </div>
                    <div class="ms-auto">
                      <a href="javascript:;"><span class="badge bg-label-primary">Support</span></a>
                    </div>
                  </div>
                </li>
                <li class="mb-3">
                  <div class="d-flex align-items-center">
                    <div class="d-flex align-items-start">
                      <div class="avatar me-2">
                        <img src="../../assets/img/icons/brands/figma-label.png" alt="Avatar" class="rounded-circle">
                      </div>
                      <div class="me-2 ms-1">
                        <h6 class="mb-0">UI Designers</h6>
                        <small class="text-muted">7 Members</small>
                      </div>
                    </div>
                    <div class="ms-auto">
                      <a href="javascript:;"><span class="badge bg-label-info">Designer</span></a>
                    </div>
                  </div>
                </li>
                <li class="mb-3">
                  <div class="d-flex align-items-center">
                    <div class="d-flex align-items-start">
                      <div class="avatar me-2">
                        <img src="../../assets/img/icons/brands/vue-label.png" alt="Avatar" class="rounded-circle">
                      </div>
                      <div class="me-2 ms-1">
                        <h6 class="mb-0">Vue.js Developers</h6>
                        <small class="text-muted">289 Members</small>
                      </div>
                    </div>
                    <div class="ms-auto">
                      <a href="javascript:;"><span class="badge bg-label-danger">Developer</span></a>
                    </div>
                  </div>
                </li>
                <li class="mb-3">
                  <div class="d-flex align-items-center">
                    <div class="d-flex align-items-start">
                      <div class="avatar me-2">
                        <img src="../../assets/img/icons/brands/twitter-label.png" alt="Avatar" class="rounded-circle">
                      </div>
                      <div class="me-2 ms-1">
                        <h6 class="mb-0">Digital Marketing</h6>
                        <small class="text-muted">24 Members</small>
                      </div>
                    </div>
                    <div class="ms-auto">
                      <a href="javascript:;"><span class="badge bg-label-secondary">Marketing</span></a>
                    </div>
                  </div>
                </li>
                <li class="text-center">
                  <a href="javascript:;">View all teams</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!--/ Teams -->
      </div>
      <!-- Projects table -->
      <div class="card mb-4">
        <div class="card-datatable table-responsive">
          <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer"><div class="card-header pb-0 pt-sm-0"><div class="head-label text-center"><h5 class="card-title mb-0">Projects</h5></div><div class="d-flex justify-content-center justify-content-md-end"><div id="DataTables_Table_0_filter" class="dataTables_filter"><label>Search:<input type="search" class="form-control" placeholder="" aria-controls="DataTables_Table_0"></label></div></div></div><table class="datatables-projects table border-top dataTable no-footer dtr-column" id="DataTables_Table_0" aria-describedby="DataTables_Table_0_info">
            <thead>
              <tr><th class="control sorting_disabled dtr-hidden" rowspan="1" colspan="1" style="width: 21.875px; display: none;" aria-label=""></th><th class="sorting_disabled dt-checkboxes-cell dt-checkboxes-select-all" rowspan="1" colspan="1" style="width: 18.2188px;" data-col="1" aria-label=""><input type="checkbox" class="form-check-input"></th><th class="sorting sorting_desc" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 83.9531px;" aria-sort="descending" aria-label="Name: activate to sort column ascending">Name</th><th class="sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 104.484px;" aria-label="Leader: activate to sort column ascending">Leader</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 78.0938px;" aria-label="Team">Team</th><th class="w-px-200 sorting" tabindex="0" aria-controls="DataTables_Table_0" rowspan="1" colspan="1" style="width: 200px;" aria-label="Status: activate to sort column ascending">Status</th><th class="sorting_disabled" rowspan="1" colspan="1" style="width: 111.375px;" aria-label="Actions">Actions</th></tr>
            </thead><tbody><tr class="odd"><td valign="top" colspan="6" class="dataTables_empty">Loading...</td></tr></tbody>
          </table><div class="row mx-2"><div class="col-sm-12 col-md-6"><div class="dataTables_info" id="DataTables_Table_0_info" role="status" aria-live="polite">Showing 0 to 0 of 0 entries</div></div><div class="col-sm-12 col-md-6"><div class="dataTables_paginate paging_simple_numbers" id="DataTables_Table_0_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="DataTables_Table_0_previous"><a aria-controls="DataTables_Table_0" aria-disabled="true" aria-role="link" data-dt-idx="previous" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item next disabled" id="DataTables_Table_0_next"><a aria-controls="DataTables_Table_0" aria-disabled="true" aria-role="link" data-dt-idx="next" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
        </div>
      </div>
    </div>
</div>
<div class="row g-4">
    @foreach ($teams as $team)
    <div class="col-xl-4 col-lg-6 col-md-6">
        <div class="card">
          <div class="card-body text-center">
            <div class="dropdown btn-pinned">
              <button type="button" class="btn dropdown-toggle hide-arrow p-0" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="ti ti-dots-vertical text-muted"></i>
              </button>
              <ul class="dropdown-menu dropdown-menu-end">
                <li><a class="dropdown-item" href="javascript:void(0);">Detail</a></li>
                <li>
                  <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item text-danger" href="javascript:void(0);">Delete</a></li>
              </ul>
            </div>
            <div class="mx-auto my-3">
              <img src="{{ $team->admin->getFirstMediaUrl('admin_images') }}" alt="{{ $team->admin->name }}" class="rounded-circle w-px-100">
            </div>
            <h4 class="mb-1 card-title text-capitalize">{{ $team->admin->name }}</h4>
            <span class="pb-1 text-capitalize">{{ $team->level }}</span>
            <div class="d-flex align-items-center justify-content-center my-3 gap-2">
              <a href="javascript:;" class="me-1"><span class="badge bg-label-secondary">Figma</span></a>
              <a href="javascript:;"><span class="badge bg-label-warning">Sketch</span></a>
            </div>

            <div class="d-flex align-items-center justify-content-around my-3 py-1">
              <div>
                <h4 class="mb-0">18</h4>
                <span>Projects</span>
              </div>
              <div>
                <h4 class="mb-0">834</h4>
                <span>Tasks</span>
              </div>
              <div>
                <h4 class="mb-0">129</h4>
                <span>Connections</span>
              </div>
            </div>
            <div class="d-flex align-items-center justify-content-center">
              <a href="javascript:;" class="btn btn-primary d-flex align-items-center me-3 waves-effect waves-light"><i class="ti-xs me-1 ti ti-user-check me-1"></i>Connected</a>
              <a href="javascript:;" class="btn btn-label-secondary btn-icon waves-effect"><i class="ti ti-mail ti-sm"></i></a>
            </div>
          </div>
        </div>
    </div>
    @endforeach
</div>
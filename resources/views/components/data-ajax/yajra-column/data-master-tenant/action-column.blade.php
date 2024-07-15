<div class="d-flex justify-content-center">
    <a href="javascript:;" class="text-body" data-bs-target="#editTenant" data-bs-toggle="modal" id="button-trigger-modal-edit-tenant" data-id="{{ $model->id }}"><i class="ti ti-pencil ti-sm mx-1"></i></a>
    <form action="{{ route('master.tenant.destroy', $model->id) }}" method="post" class="form-delete-tenant-{{ $model->id }}">
        @csrf
        @method('delete')
        <a href="javascript:;" class="text-body" data-id="{{ $model->id }}" id="button-delete-tenant">
            <i class="ti ti-trash ti-sm mx-2"></i>
        </a>
    </form>
    <a href="javascript:;" class="text-body dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-sm mx-1"></i></a>
    <div class="dropdown-menu dropdown-menu-end m-0">
        <a href="{{ route('master.tenant.show', $model->id) }}" target="_blank" class="dropdown-item">Details</a>
        <form action="{{ route('master.tenant.update.status', $model->id) }}" method="post">
            @csrf
            @method('PATCH')
        <button type="submit" class="dropdown-item">{{ $model->status == 'active' ? 'Nonactive' : 'Active' }}</button>
        </form>
    </div>
</div>
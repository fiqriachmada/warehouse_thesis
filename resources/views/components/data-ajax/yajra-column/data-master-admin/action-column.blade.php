<div class="d-flex justify-content-center">
    @if (auth()->user()->attribute == 'core')
    <a href="javascript:;" class="text-body" data-bs-target="#editAdmin" data-bs-toggle="modal" id="button-trigger-modal-edit-admin" data-id="{{ $model->id }}"><i class="ti ti-pencil ti-sm mx-1"></i></a>
    <form action="{{ route('master.admin.destroy', $model->admin->id) }}" method="post" class="form-delete-admin-{{ $model->admin->id }}">
        @csrf
        @method('delete')
        <a href="javascript:;" class="text-body" data-id="{{ $model->admin->id }}" id="button-delete-admin">
            <i class="ti ti-trash ti-sm mx-2"></i>
        </a>
    </form>
    @endif
    <a href="javascript:;" class="text-body dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-sm mx-1"></i></a>
    <div class="dropdown-menu dropdown-menu-end m-0">
        <a href="{{ route('master.admin.show', $model->admin->id) }}" target="_blank" class="dropdown-item">Details</a>
        @if (auth()->user()->attribute == 'core')
        <form action="{{ route('master.admin.update.status', $model->admin->id) }}" method="post">
            @csrf
            @method('PATCH')
        <button type="submit" class="dropdown-item">{{ $model->admin->status == 'active' ? 'Nonaktifkan' : 'Aktifkan' }}</button>
        </form>
        @endif
    </div>
</div>
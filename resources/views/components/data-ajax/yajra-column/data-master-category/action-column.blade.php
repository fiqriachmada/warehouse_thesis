<div class="d-flex justify-content-center">
    @if (auth()->user()->attribute == 'core')
    <a href="javascript:;" class="text-body" data-bs-target="#editWarehouseCategory" data-bs-toggle="modal" id="button-trigger-modal-edit-warehouse-category" data-id="{{ $model->id }}"><i class="ti ti-pencil ti-sm mx-1"></i></a>
    <form action="{{ route('master.warehouse.category.destroy', $model->id) }}" method="post" class="form-delete-warehouse-category-{{ $model->id }}">
        @csrf
        @method('delete')
        <a href="javascript:;" class="text-body" data-id="{{ $model->id }}" id="button-delete-warehouse-category">
            <i class="ti ti-trash ti-sm mx-2"></i>
        </a>
    </form>
    @endif
    <a href="javascript:;" class="text-body dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-sm mx-1"></i></a>
    <div class="dropdown-menu dropdown-menu-end m-0">
        <a href="{{ route('master.warehouse.category.show', $model->id) }}" target="_blank" class="dropdown-item">Details</a>
    </div>
</div>
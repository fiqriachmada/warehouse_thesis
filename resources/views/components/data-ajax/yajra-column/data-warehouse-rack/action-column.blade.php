<div class="d-flex justify-content-center">
    <a href="javascript:;" class="text-body" data-bs-target="#editRack" data-bs-toggle="modal" id="button-trigger-modal-edit-rack" data-id="{{ $model->id }}"><i class="ti ti-pencil ti-sm mx-1"></i></a>
    <form action="{{ route('warehouse.rack.destroy', ['warehouse' => $model->warehouse_id, 'rack' => $model->id]) }}" method="post" class="form-delete-rack-{{ $model->id }}">
        @csrf
        @method('delete')
        <a href="javascript:;" class="text-body" data-id="{{ $model->id }}" id="button-delete-rack">
            <i class="ti ti-trash ti-sm mx-2"></i>
        </a>
    </form>
    <a href="{{ route('warehouse.rack.show', ['warehouse' => $model->warehouse_id, 'rack' => $model->id]) }}" class="text-body">
        <i class="ti ti-eye ti-sm mx-2"></i>
    </a>
</div>
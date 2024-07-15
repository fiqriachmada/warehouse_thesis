<div class="d-flex justify-content-center">
    <a href="javascript:;" class="text-body" data-bs-target="#editSupplier" data-bs-toggle="modal" id="button-trigger-modal-edit-supplier" data-id="{{ $model->id }}"><i class="ti ti-pencil ti-sm mx-1"></i></a>
    <form action="{{ route('warehouse.suppliers.destroy', ['warehouse' => $model->warehouse_id, 'supplier' => $model->id]) }}" method="post" class="form-delete-supplier-{{ $model->id }}">
        @csrf
        @method('delete')
        <a href="javascript:;" class="text-body" data-id="{{ $model->id }}" id="button-delete-supplier">
            <i class="ti ti-trash ti-sm mx-2"></i>
        </a>
    </form>
</div>
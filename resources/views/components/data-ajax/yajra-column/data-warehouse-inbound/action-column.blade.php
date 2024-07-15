<div class="d-flex justify-content-center">
    <a href="javascript:;" class="text-body" data-bs-target="#editInbound" data-bs-toggle="modal" id="button-trigger-modal-edit-inbound" data-id="{{ $model->id }}"><i class="ti ti-pencil ti-sm mx-1"></i></a>
    <form action="{{ route('warehouse.inbound.destroy', $model->id) }}" method="post" class="form-delete-inbound-{{ $model->id }}">
        @csrf
        @method('delete')
        <a href="javascript:;" class="text-body" data-id="{{ $model->id }}" id="button-delete-inbound">
            <i class="ti ti-trash ti-sm mx-2"></i>
        </a>
    </form>
</div>
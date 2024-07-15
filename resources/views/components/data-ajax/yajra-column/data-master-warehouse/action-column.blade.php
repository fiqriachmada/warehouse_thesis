@if ($type == 'show')
<div class="d-flex justify-content-center">
    <a href="{{ route('master.warehouse.edit', $model->id) }}" class="text-body"><i class="ti ti-pencil ti-sm mx-1"></i></a>
    <form action="{{ route('master.warehouse.destroy', $model->id) }}" method="post" class="form-delete-warehouse-{{ $model->id }}">
        @csrf
        @method('delete')
        <a href="javascript:;" class="text-body" data-id="{{ $model->id }}" id="button-delete-warehouse">
            <i class="ti ti-trash ti-sm mx-2"></i>
        </a>
    </form>
    <a href="javascript:;" class="text-body dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="ti ti-dots-vertical ti-sm mx-1"></i></a>
    <div class="dropdown-menu dropdown-menu-end m-0">
        <a href="{{ route('master.warehouse.show', $model->id) }}" target="_blank" class="dropdown-item">Details</a>
    </div>
</div>
@elseif ($type == 'choose')
<div class="d-flex justify-content-center">
    <form action="{{ route('calculation.rental.price.store', $model->id) }}" method="post" class="form-choose-warehouse-{{ $model->id }}">
        @csrf
        <a href="javascript:;" class="text-body" data-id="{{ $model->id }}" id="button-choose-warehouse"><i class="ti ti-check ti-sm mx-2"></i></a>
    </form>
</div>
@endif
<div class="d-flex justify-content-center">
    <a href="{{ route('warehouse.products.edit', ['warehouse' => $model->warehouse_id, 'product' => $model->id]) }}" class="text-body"><i class="ti ti-pencil ti-sm mx-1"></i></a>
    <form action="{{ route('warehouse.products.destroy', ['warehouse' => $model->warehouse_id, 'product' => $model->id]) }}" method="post" class="form-delete-product-{{ $model->id }}">
        @csrf
        @method('delete')
        <a href="javascript:;" class="text-body" data-id="{{ $model->id }}" id="button-delete-product">
            <i class="ti ti-trash ti-sm mx-2"></i>
        </a>
    </form>
</div>
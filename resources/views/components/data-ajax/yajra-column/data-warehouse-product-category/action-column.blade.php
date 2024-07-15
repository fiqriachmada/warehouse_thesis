<div class="d-flex justify-content-center">
    <a href="javascript:;" class="text-body" data-bs-target="#editProductCategory" data-bs-toggle="modal" id="button-trigger-modal-edit-product-category" data-id="{{ $model->id }}"><i class="ti ti-pencil ti-sm mx-1"></i></a>
    <form action="{{ route('warehouse.product.categories.destroy', ['warehouse' => $model->warehouse_id, 'category' => $model->id]) }}" method="post" class="form-delete-product-category-{{ $model->id }}">
        @csrf
        @method('delete')
        <a href="javascript:;" class="text-body" data-id="{{ $model->id }}" id="button-delete-product-category">
            <i class="ti ti-trash ti-sm mx-2"></i>
        </a>
    </form>
    <a href="{{ route('warehouse.product.categories.show', ['warehouse' => $model->warehouse_id, 'category' => $model->id]) }}" class="text-body">
        <i class="ti ti-eye ti-sm mx-2"></i>
    </a>
</div>
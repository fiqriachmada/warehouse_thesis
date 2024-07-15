<div class="d-flex justify-content-center">
    <form action="{{ route('warehouse.outbound.customer.store', ['warehouse' => $warehouse->id, 'customer' => $model->id]) }}" method="post" id="form-add-customer-to-cart">
        @csrf
        <a href="javascript:void(0);" class="text-body" id="btn-add-customer-to-cart"><i class="ti ti-square-check ti-sm mx-1"></i></a>
    </form>
</div>
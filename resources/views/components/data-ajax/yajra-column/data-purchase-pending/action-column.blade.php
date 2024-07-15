<div class="d-flex justify-content-center">
    <a href="{{ route('purchase.show', $model->id) }}" class="text-body" target="_blank"><i class="ti ti-eye ti-sm mx-1"></i></a>
    {{-- <form action="{{ route('purchase.update', ['transaction' => $model->id, 'status' => $model->status]) }}" method="post" class="d-inline">
        @csrf
        @method('PATCH')
        <button type="submit" class="text-body bg-transparent border-0" title="Approve"><i class="ti ti-check ti-sm mx-1"></i></button>
    </form>
    <form action="{{ route('purchase.update', ['transaction' => $model->id, 'status' => 'declined']) }}" method="post" class="d-inline">
        @csrf
        @method('PATCH')
        <button type="submit" class="text-body bg-transparent border-0" title="Approve"><i class="ti ti-x ti-sm mx-1"></i></button>
    </form> --}}
</div>
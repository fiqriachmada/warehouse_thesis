<form action="{{ route('warehouse.inbound.update', $inbound->id)}}" method="POST" class="row g-3" id="form-edit-inbound">
    @csrf
    @method('PATCH')
    <div class="col-6 col-md-6">
      <label class="form-label" for="product_id">Product</label>
        <select name="product_id" id="product_id" class="form-control">
            @foreach ($products as $product)

                <option value="{{ $product->id }}" {{ $inbound->product_id == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-6 col-md-6">
      <label class="form-label" for="supplier_id">Supplier</label>
        <select name="supplier_id" id="supplier_id" class="form-control">
            @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->id }}" {{ $inbound->supplier_id == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
            @endforeach
        </select>
    </div>
    <div class="col-6 col-md-6">
      <label class="form-label" for="code">Code <small class="text-danger d-none" id="label-code-inbound-message"></small></label>
      <input
        type="text"
        id="code"
        name="code"
        class="form-control"
        value="{{ $inbound->code }}"
        disabled/>
        <div class="form-check form-check-inline mt-3">
            <input class="form-check-input" type="checkbox" id="change-code-inbound">
            <label class="form-check-label" for="change-code-inbound">Change</label>
        </div>
    </div>
    <div class="col-6 col-md-6">
      <label class="form-label" for="price">Price</label>
      <input
        type="text"
        id="price"
        name="price"
        class="form-control"
        value="{{ $inbound->price }}"/>
    </div>
    <div class="col-6 col-md-6">
      <label class="form-label" for="on_hand">Stock On Hand</label>
      <input
        type="number"
        id="on_hand"
        name="on_hand"
        class="form-control"
        value="{{ $inbound->on_hand }}"/>
    </div>
    <div class="col-6 col-md-6">
        <label class="form-label" for="received_at">Received At</label>
        <div class="position-relative">
            <input type="datetime-local" id="received_at" name="received_at" class="form-control" min="1" value="{{ Carbon\Carbon::parse($inbound->received_at)->format('Y-m-d\TH:i') }}">
        </div>
    </div>
    <div class="col-12 text-center">
      <button type="submit" class="btn btn-primary me-sm-3 me-1" id="btn-submit-edit-inbound">Submit</button>
      <button
        type="reset"
        class="btn btn-label-secondary"
        data-bs-dismiss="modal"
        aria-label="Close">
        Cancel
      </button>
    </div>
</form>

<script>
    $(document).on('click', '#change-code-inbound', function() {
        if (this.checked) {
            $('#code').prop('disabled', false);
        } else {
            $('#code').prop('disabled', true);
        }
    });

    $(document).on('input', '#code', function() {
        let code = $(this).val();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
    
        $.ajax({
            url: "/ajax/inbound/code-check",
            method: "post",
            data: {
                code: code
            },
            success: function(response) {
                if (response > 0) {
                    $('#label-code-inbound-message').removeClass('d-none');
                    $('#label-code-inbound-message').text('Code already exist');
                    $('#btn-submit-edit-inbound').prop('disabled', true);
                } else {
                    $('#label-code-inbound-message').addClass('d-none');
                    $('#btn-submit-edit-inbound').prop('disabled', false);
                }
            },
            error: function(xhr, status, error) {
            }
        });
    });

    $(document).on('submit', '#form-edit-inbound', function(event) {
        if ($('#btn-submit-edit-inbound').is(':disabled')) {
            event.preventDefault();
            alert('Form cannot be submitted because the code already exists.');
        }
    });
</script>
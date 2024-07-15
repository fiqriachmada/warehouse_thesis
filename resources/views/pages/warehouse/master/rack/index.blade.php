@extends('layouts.warehouse')

@section('title')
    Master - List Racks
@endsection

@section('section-warehouse')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-3">List Racks</h5>
      </div>
      <div class="card-datatable table-responsive">
        <table class="table border-top" id="listWarehouseRacksTable" data-id="{{ $warehouse->id }}">
          <thead>
            <tr>
              <th></th>
              <th class="text-center">No</th>
              <th class="text-center">Rack</th>
              <th class="text-center">Total Products</th>
              <th class="text-center">Action</th>
            </tr>
          </thead>
        </table>
      </div>

      <div
        class="offcanvas offcanvas-end"
        tabindex="-1"
        id="offcanvasAddUser"
        aria-labelledby="offcanvasAddUserLabel">
        <div class="offcanvas-header">
          <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Form Racks</h5>
          <button
            type="button"
            class="btn-close text-reset"
            data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
          <form action="{{ route('warehouse.racks.store', $warehouse->id) }}" method="POST" class="add-new-user pt-0" id="addNewRackForm">
            @csrf
            <div class="mb-3">
              <label class="form-label" for="name">Rack</label>
              <input
                type="text"
                class="form-control"
                id="name"
                name="name"
                value="{{ old('name') }}"
                required />
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
          </form>
        </div>
      </div>
    </div>
</div>
@endsection
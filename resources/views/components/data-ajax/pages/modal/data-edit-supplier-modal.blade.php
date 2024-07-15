<form action="{{ route('warehouse.suppliers.update', $supplier->id) }}" method="POST" class="row g-3">
    @csrf
    @method('PATCH')
    <div class="col-12 col-md-12">
      <label class="form-label" for="name">Supplier</label>
      <input
        type="text"
        id="name"
        name="name"
        class="form-control"
        value="{{ old('name', $supplier->name) }}" 
        required/>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-6 col-md-6">
      <label class="form-label" for="email">Email</label>
      <input
        type="email"
        id="email"
        name="email"
        class="form-control"
        value="{{ old('email', $supplier->email) }}" 
        required/>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-6 col-md-6">
      <label class="form-label" for="phone">Phone</label>
      <input
        type="text"
        id="phone"
        name="phone"
        class="form-control"
        value="{{ old('phone', $supplier->phone) }}" 
        required/>
        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 col-md-12">
      <label class="form-label" for="address">Address</label>
      <textarea name="address" id="address" class="form-control" cols="30" rows="10">{{ old('address', $supplier->address) }}</textarea>
        @error('address')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 text-center">
      <button type="submit" class="btn btn-primary me-sm-3 me-1">Submit</button>
      <button
        type="reset"
        class="btn btn-label-secondary"
        data-bs-dismiss="modal"
        aria-label="Close">
        Cancel
      </button>
    </div>
</form>
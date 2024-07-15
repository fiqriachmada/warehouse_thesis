<form action="{{ route('warehouse.customers.store', $warehouse->id) }}" method="POST" class="row g-3">
    @csrf
    <div class="col-4 col-md-4">
      <label class="form-label" for="name">Customer Name</label>
      <input
        type="text"
        id="name"
        name="name"
        class="form-control"
        value="{{ old('name') }}" 
        required/>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-4 col-md-4">
      <label class="form-label" for="email">Customer Email</label>
      <input
        type="email"
        id="email"
        name="email"
        class="form-control"
        value="{{ old('email') }}" 
        required/>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-4 col-md-4">
      <label class="form-label" for="phone">Customer Phone</label>
      <input
        type="text"
        id="phone"
        name="phone"
        class="form-control"
        value="{{ old('phone') }}" 
        required/>
        @error('phone')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-6 col-md-6">
      <label class="form-label" for="address">Customer Address</label>
      <textarea name="address" id="address" cols="10" rows="5" class="form-control" required></textarea>
    </div>
    <div class="col-6 col-md-6">
      <label class="form-label d-block">Customer Type</label>
      <div class="form-check form-check-inline mt-3">
        <input class="form-check-input" type="radio" name="type" id="individual" value="individual" checked>
        <label class="form-check-label" for="individual">Individual</label>
      </div>
      <div class="form-check form-check-inline mt-3">
        <input class="form-check-input" type="radio" name="type" id="corporate" value="corporate">
        <label class="form-check-label" for="corporate">Corporate</label>
      </div>
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
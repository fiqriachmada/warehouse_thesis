<form action="{{ route('master.warehouse.category.update', $warehouse_category->id) }}" method="POST" class="row g-3">
    @csrf
    @method('PATCH')
    <div class="col-12 col-md-12">
      <label class="form-label" for="category">Category</label>
      <input
        type="text"
        id="category"
        name="category"
        class="form-control"
        value="{{ old('category', $warehouse_category->category) }}" 
        required/>
        @error('category')
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
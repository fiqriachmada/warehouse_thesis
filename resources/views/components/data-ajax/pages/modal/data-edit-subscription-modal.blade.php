<form action="{{ route('master.subscription.update', $subscription->id) }}" method="POST" class="row g-3">
    @csrf
    @method('PATCH')
    <div class="col-12 col-md-6">
      <label class="form-label" for="name">Subscription Name</label>
      <input
        type="text"
        id="name"
        name="name"
        class="form-control"
        value="{{ old('name', $subscription->name) }}" 
        required/>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 col-md-6">
      <label class="form-label" for="month_duration">Month Duration</label>
      <input
        type="number"
        id="month_duration"
        name="month_duration"
        class="form-control"
        value="{{ old('month_duration', $subscription->month_duration) }}" 
        min="1"
        required/>
        @error('month_duration')
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
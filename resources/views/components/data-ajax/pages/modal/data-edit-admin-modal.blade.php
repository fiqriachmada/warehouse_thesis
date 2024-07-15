<form action="{{ route('master.admin.update', $admin->id) }}" method="POST" class="row g-3">
    @csrf
    @method('PATCH')
    <div class="col-12 col-md-12">
      <label class="form-label" for="name">Admin</label>
      <input
        type="text"
        id="name"
        name="name"
        class="form-control"
        value="{{ old('name', $admin->name) }}" 
        required/>
        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12">
        <label class="form-label" for="email">Email</label>
        <input
            type="email"
            id="email"
            name="email"
            class="form-control"
            value="{{ old('email', $admin->email) }}" 
            required/>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label" for="phone">Contact</label>
        <input
          type="text"
          id="phone"
          name="phone"
          class="form-control"
          value="{{ old('phone', $admin->phone) }}" 
          required/>
          @error('phone')
              <div class="invalid-feedback">{{ $message }}</div>
          @enderror
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label" for="pob">Place Of Birth</label>
        <input
            type="text"
            id="pob"
            name="pob"
            class="form-control"
            value="{{ old('pob', $admin->pob) }}" 
            required/>
        @error('pob')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label" for="dob">Date Of Birth</label>
        <input
            type="date"
            id="dob"
            name="dob"
            class="form-control"
            value="{{ old('dob', $admin->dob) }}" 
            required/>
        @error('dob')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-12 col-md-6">
        <label class="form-label d-block">Gender</label>
        <div class="form-check form-check-inline mt-2">
            <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{ old('gender', $admin->gender) == 'male' ? 'checked' : '' }}>
            <label class="form-check-label" for="male">Male</label>
        </div>
        <div class="form-check form-check-inline mt-2">
            <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{ old('gender', $admin->gender) == 'female' ? 'checked' : '' }}>
            <label class="form-check-label" for="female">Female</label>
        </div>
    </div>
    <div class="col-12 col-md-12">
        <label class="form-label" for="address">Address</label>
        <textarea class="form-select" name="address" id="address" cols="30" rows="10" required>{{ old('address', $admin->address) }}</textarea>
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
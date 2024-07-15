<form action="{{ route('tenant.settings.profile.update', auth()->user()->tenant->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PATCH')
    <div class="card mb-4">
        <h5 class="card-header">Profile Details</h5>
        <div class="card-body">
            <div class="d-flex align-items-start align-items-sm-center gap-4">
                @if (auth()->user()->tenant->getFirstMediaUrl('tenant_images'))
                    <img src="{{ auth()->user()->tenant->getFirstMediaUrl('tenant_images') }}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded img-preview" id="uploadedAvatar">
                @else
                    <img src="{{ asset('assets/img/avatars/14.png') }}" alt="user-avatar" class="d-block w-px-100 h-px-100 rounded img-preview" id="uploadedAvatar">
                @endif
                <div class="button-wrapper">
                <label for="image" class="btn btn-primary me-2 mb-3 waves-effect waves-light" tabindex="0">
                    <span class="d-none d-sm-block">Upload new photo</span>
                    <i class="ti ti-upload d-block d-sm-none"></i>
                    <input type="file" id="image" name="tenant_image" class="account-file-input" hidden="" accept="image/png, image/jpeg" onchange="previewImage()">
                </label>
                @error('tenant_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                </div>
            </div>
        </div>
        <hr class="my-0">
        <div class="card-body">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="name" class="form-label">Name</label>
                    <input class="form-control" type="text" id="name" name="name" value="{{ old('name', auth()->user()->tenant->name) }}" required>
                    @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label for="npwp" class="form-label">NPWP</label>
                    <input class="form-control" type="text" id="npwp" name="npwp" value="{{ old('npwp', auth()->user()->tenant->npwp) }}" required>
                    @error('npwp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input class="form-control" type="email" id="email" name="email" value="{{ old('email', auth()->user()->tenant->email) }}" required>
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label for="phone" class="form-label">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', auth()->user()->tenant->phone) }}">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                {{-- <div class="mb-3 col-md-6">
                    <label for="pob" class="form-label">Place Of Birth</label>
                    <input type="text" class="form-control" id="pob" name="pob" value="{{ old('pob', auth()->user()->tenant->pob) }}">
                    @error('pob')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="mb-3 col-md-6">
                    <label for="dob" class="form-label">Date Of Birth</label>
                    <input type="date" class="form-control" id="dob" name="dob" value="{{ old('dob', auth()->user()->tenant->dob) }}">
                    @error('dob')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 col-md-6">
                    <label class="form-label d-block">Gender</label>
                    <div class="form-check form-check-inline mt-2">
                        <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{ old('gender', auth()->user()->tenant->gender) == 'male' ? 'checked' : '' }}>
                        <label class="form-check-label" for="male">Male</label>
                    </div>
                    <div class="form-check form-check-inline mt-2">
                        <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{ old('gender', auth()->user()->tenant->gender) == 'female' ? 'checked' : '' }}>
                        <label class="form-check-label" for="female">Female</label>
                    </div>
                </div> --}}
                <div class="mb-3 col-md-6">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" id="address" cols="30" rows="5" class="form-control">{{ old('address', auth()->user()->tenant->address) }}</textarea>
                    @error('address')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="mt-2">
                <button type="submit" class="btn btn-primary me-2 waves-effect waves-light">Save changes</button>
                <button type="reset" class="btn btn-label-secondary waves-effect">Cancel</button>
            </div>
        </div>
    </div>
</form>

<div class="card">
    <h5 class="card-header">Deactivate Account</h5>
    <div class="card-body">
      <div class="mb-3 col-12 mb-0">
        <div class="alert alert-warning">
          <h5 class="alert-heading mb-1">Are you sure want to deactivate your account?</h5>
          <p class="mb-0">You won't be able to recover your account.</p>
        </div>
      </div>
      <form id="formAccountDeactivation" onsubmit="return false" class="fv-plugins-bootstrap5 fv-plugins-framework form-update-deactivate-profile-settings" novalidate="novalidate">
          <div class="form-check mb-4">
              <input class="form-check-input" type="checkbox" name="accountActivation" id="accountActivation">
              <label class="form-check-label" for="accountActivation">I confirm my account deactivation.</label>
              <div class="fv-plugins-message-container invalid-feedback"></div>
          </div>
        <button type="submit" class="btn btn-danger deactivate-account waves-effect waves-light">Deactivate Account</button>
      </form>
    </div>
</div>
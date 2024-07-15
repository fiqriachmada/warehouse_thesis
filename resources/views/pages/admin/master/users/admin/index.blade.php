@extends('layouts.admin')

@section('title')
    Master - List Admin
@endsection

@section('section-admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-3">List Admins</h5>
      </div>
      <div class="card-datatable table-responsive">
        <table class="table border-top" id="listAdminsTable">
          <thead>
            <tr>
              <th></th>
              <th class="text-center">No</th>
              <th class="text-center">Admin</th>
              <th class="text-center">Email</th>
              <th class="text-center">Phone</th>
              <th class="text-center">Place & Date Of Birth</th>
              <th class="text-center">Gender</th>
              <th class="text-center">Address</th>
              <th class="text-center">Registered At</th>
              <th class="text-center">Status</th>
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
          <h5 id="offcanvasAddUserLabel" class="offcanvas-title">Form Admin</h5>
          <button
            type="button"
            class="btn-close text-reset"
            data-bs-dismiss="offcanvas"
            aria-label="Close"></button>
        </div>
        <div class="offcanvas-body mx-0 flex-grow-0 pt-0 h-100">
          <form action="{{ route('master.admin.store') }}" method="POST" class="add-new-user pt-0" id="addNewAdminForm" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
              <label class="form-label" for="name">Name</label>
              <input
                type="text"
                class="form-control"
                placeholder="John Doe"
                aria-label="John Doe"
                id="name"
                name="name"
                value="{{ old('name') }}" />
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
              <label class="form-label" for="email">Email</label>
              <input
                type="email"
                class="form-control"
                id="email"
                name="email"
                value="{{ old('email') }}" />
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="phone">Phone</label>
                <input
                  type="text"
                  id="phone"
                  class="form-control"
                  placeholder="+(031) 988-44-11"
                  name="phone"
                  value="{{ old('phone') }}" />
                  @error('phone')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="pob">Place Of Birth</label>
                <input
                  type="text"
                  id="pob"
                  class="form-control"
                  placeholder="City"
                  name="pob"
                  value="{{ old('pob') }}" />
                  @error('pob')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
            </div>
            <div class="mb-3">
                <label class="form-label" for="dob">Date Of Birth</label>
                <input
                  type="date"
                  id="dob"
                  class="form-control"
                  name="dob"
                  value="{{ old('dob') }}" />
                  @error('dob')
                      <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
            </div>
            <div class="mb-3">
                <label class="form-label d-block" for="age">Gender</label>
                <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}>
                    <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="form-check form-check-inline mt-3">
                    <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
                    <label class="form-check-label" for="female">Female</label>
                </div>
                @error('gender')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
              <label class="form-label" for="address">Address</label>
              <textarea class="form-control" name="address" id="address" cols="10" rows="10">{{ old('address') }}</textarea>
            </div>
            <div class="mb-3">
              <label class="form-label" for="admin_image">Image</label>
              <input type="file" class="form-control" name="admin_image" id="admin_image">
            </div>
            <div class="mb-3">
              <label class="form-label" for="username">Username</label>
              <input
                type="text"
                id="username"
                class="form-control"
                placeholder="JohnDoe123"
                aria-label="JohnDoe123"
                name="username"
                value="{{ old('username') }}" />
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
              <label class="form-label" for="password">Password</label>
              <input
                type="password"
                id="password"
                class="form-control"
                name="password" />
            </div>
            <div class="mb-3">
              <label class="form-label" for="confirm-password">Confirm Password</label>
              <input
                type="password"
                id="confirm-password"
                class="form-control"
                name="confirm-password" />
            </div>
            <button type="submit" class="btn btn-primary me-sm-3 me-1 data-submit">Submit</button>
            <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="offcanvas">Cancel</button>
          </form>
        </div>
      </div>
    </div>
</div>
@endsection
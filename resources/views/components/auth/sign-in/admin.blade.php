@extends('layouts.admin')

@section('section-admin-authentication')
<div class="card">
    <div class="card-body">
      <h4 class="mb-1 pt-2">Welcome Back!</h4>
      <p class="mb-4">Please sign-in to your account and start the adventure</p>
    
    <form id="formAuthentication" class="mb-3 fv-plugins-bootstrap5 fv-plugins-framework" action="{{ route('login.store', 'admin') }}" method="POST">
        @csrf
        <div class="mb-3 fv-plugins-icon-container">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" autofocus="">
            @error('username')
                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3 form-password-toggle fv-plugins-icon-container">
            <div class="d-flex justify-content-between">
                <label class="form-label" for="password">Password</label>
            </div>
            <div class="input-group input-group-merge has-validation">
                <input type="password" id="password" class="form-control" name="password" placeholder="············">
                <span class="input-group-text cursor-pointer">
                    <i class="ti ti-eye-off"></i>
                </span>
            </div>
            <div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
        <div class="mb-3">
            <button class="btn btn-primary d-grid w-100 waves-effect waves-light" type="submit">Sign in</button>
        </div>
    </form>
    </div>
</div>
@endsection
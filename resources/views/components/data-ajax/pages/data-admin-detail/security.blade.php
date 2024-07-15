@if (auth()->user()->attribute == 'core')
<div class="card mb-4">
    <h5 class="card-header">Change Password</h5>
    <div class="card-body">
    <form action="{{ route('master.admin.update.password', $admin->id) }}" id="formChangePassword" method="POST" class="fv-plugins-bootstrap5 fv-plugins-framework">
        @csrf
        @method('PATCH')
        <div class="alert alert-warning" role="alert">
        <h5 class="alert-heading mb-2">Ensure that these requirements are met</h5>
        <span>Minimum 8 characters long, uppercase &amp; symbol</span>
        </div>
        <div class="row">
        <div class="mb-3 col-12 col-sm-6 form-password-toggle fv-plugins-icon-container">
            <label class="form-label" for="newPassword">New Password</label>
            <div class="input-group input-group-merge has-validation">
            <input class="form-control" type="password" id="newPassword" name="newPassword" placeholder="············">
            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
            </div><div class="fv-plugins-message-container invalid-feedback"></div>
        </div>

        <div class="mb-3 col-12 col-sm-6 form-password-toggle fv-plugins-icon-container">
            <label class="form-label" for="confirmPassword">Confirm New Password</label>
            <div class="input-group input-group-merge has-validation">
            <input class="form-control" type="password" name="confirmPassword" id="confirmPassword" placeholder="············">
            <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
            </div><div class="fv-plugins-message-container invalid-feedback"></div>
        </div>
        <div>
            <button type="submit" class="btn btn-primary me-2 waves-effect waves-light" id="button-password-change">Change Password</button>
        </div>
        </div>
    </form>
    </div>
</div>
@endif

<script src="{{ asset('assets/js/app-user-view-security.js') }}"></script>
<form class="row g-3 fv-plugins-bootstrap5 fv-plugins-framework" action="{{ route('admin.settings.billing.update', $bank->id) }}" method="POST">
  @csrf
  @method('PATCH')

  <div class="col-12 fv-plugins-icon-container">
    <label class="form-label w-100" for="bank_account_number">Bank Account Number</label>
    <div class="input-group">
      <input id="bank_account_number" name="bank_account_number" class="form-control" type="text" placeholder="Bank Account Number" value="{{ old('bank_account_number', $bank->bank_account_number) }}" autocomplete="off" required>
    </div>
  </div>

  <div class="col-12 col-md-6">
    <label class="form-label" for="account_holder_name">Account Holder Name</label>
    <input type="text" id="account_holder_name" name="account_holder_name" class="form-control" placeholder="Account Holder Name" value="{{ old('account_holder_name', $bank->account_holder_name) }}" autocomplete="off" required>
  </div>

  <div class="col-12 col-md-6">
    <label class="form-label" for="bank_name">Bank Name</label>
    <input type="text" id="bank_name" name="bank_name" class="form-control" placeholder="Bank Name" value="{{ old('bank_name', $bank->bank_name) }}" autocomplete="off" required>
  </div>

  <div class="col-12">
    <label class="switch">
      <input type="checkbox" class="switch-input" name="status" {{ $bank->status == 'primary' ? 'checked' : '' }}>
      <span class="switch-toggle-slider">
        <span class="switch-on"></span>
        <span class="switch-off"></span>
      </span>
      <span class="switch-label">Set as primary account bank</span>
    </label>
  </div>

  <div class="col-12 text-center">
    <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">Update</button>
    <button type="reset" class="btn btn-label-danger waves-effect" data-bs-dismiss="modal" aria-label="Close">
      Cancel
    </button>
  </div>

</form>
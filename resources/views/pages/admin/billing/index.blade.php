@extends('layouts.admin')

@section('section-admin')
<div class="container-xxl flex-grow-1 container-p-y">

  <div class="card mb-4">
    <h5 class="card-header">Payment Methods</h5>
    <div class="card-body">
      <div class="row">
        <div class="col-md-6">
          <form id="creditCardForm" class="row g-3 fv-plugins-bootstrap5 fv-plugins-framework fv-plugins-icon-container" onsubmit="return false" novalidate="novalidate" action="{{ route('admin.settings.billing.store') }}" method="POST">
            @csrf
            <div class="col-12">
              <label class="form-label w-100" for="bank_account_number">Bank Account Number</label>
              <div class="input-group input-group-merge has-validation">
                <input id="bank_account_number" name="bank_account_number" class="form-control @error('bank_account_number') is-invalid @enderror" type="text" placeholder="Bank Account Number" value="{{ old('bank_account_number') }}" autocomplete="off">
                <span class="input-group-text cursor-pointer p-1" id="paymentCard2"><span class="card-type"></span></span>
              </div>
              @error('bank_account_number')
                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="account_holder_name">Account Holder Name</label>
              <input type="text" name="account_holder_name" id="account_holder_name" class="form-control @error('account_holder_name') is-invalid @enderror" placeholder="Account Holder Name" value="{{ old('account_holder_name') }}" autocomplete="off">
              @error('account_holder_name')
                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-12 col-md-6">
              <label class="form-label" for="bank_name">Bank Name</label>
              <input type="text" name="bank_name" id="bank_name" class="form-control @error('bank_name') is-invalid @enderror" placeholder="Bank Name" value="{{ old('bank_name') }}" autocomplete="off">
              @error('bank_name')
                <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="col-12 mt-4">
              <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light" id="button-add-biling-submit">Save Changes</button>
              <button type="reset" class="btn btn-label-secondary waves-effect">Cancel</button>
            </div>
          <input type="hidden"></form>
        </div>

        <div class="col-md-6 mt-5 mt-md-0">
          <h6>My Banks</h6>
          @foreach ($bills as $bill)
          <div class="added-cards">
            <div class="cardMaster bg-lighter p-3 rounded mb-3">
              <div class="d-flex justify-content-between flex-sm-row flex-column">
                <div class="card-information me-2">
                  <h5 class="mb-1 text-uppercase">{{ $bill->bank_name }}</h5>
                  <div class="d-flex align-items-center mb-2 flex-wrap gap-2">
                    <p class="mb-0 me-2 text-capitalize">{{ $bill->account_holder_name }}</p>
                    <span class="badge bg-label-{{ $bill->status == 'primary' ? 'primary' : 'secondary' }} text-capitalize">{{ $bill->status }}</span>
                  </div>
                  <span class="card-number">{{ $bill->bank_account_number }}</span>
                </div>
                <div class="d-flex flex-column text-start text-lg-end">
                  <div class="d-flex order-sm-0 order-1 mt-sm-0 mt-3">
                    <button class="btn btn-label-primary me-2 waves-effect" data-bs-toggle="modal" data-bs-target="#editBankAccountModal" data-id="{{ $bill->id }}" id="button-trigger-modal-edit-bank-account">
                      Edit
                    </button>
                    <form action="{{ route('admin.settings.billing.destroy', $bill->id) }}" method="post" id="form-delete-bank-account-{{ $bill->id }}" class="d-inline">
                      @csrf
                      @method('DELETE')
                      <button type="button" class="btn btn-label-secondary waves-effect" id="button-delete-bank-account" data-id="{{ $bill->id }}">Delete</button>
                    </form>
                  </div>
                  <small class="mt-sm-auto mt-2 order-sm-1 order-0">Added on {{ $bill->created_at->diffForHumans() }}</small>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
      </div>
    </div>
</div>

<div class="card">
  <div class="card-header border-bottom">
    <h5 class="card-title mb-3">Billing History</h5>
  </div>
  <div class="card-datatable table-responsive">
    <table class="table border-top" id="listBillsHistoryTable">
      <thead>
        <tr>
          <th></th>
          <th class="text-center">No</th>
          <th class="text-center">Client</th>
          <th class="text-center">Bank</th>
          <th class="text-center">Issued Date</th>
          <th class="text-center">Balance</th>
        </tr>
      </thead>
    </table>
  </div>
</div>
</div>
@endsection
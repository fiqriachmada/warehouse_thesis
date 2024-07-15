@extends('layouts.warehouse')

@section('title')
    Inbound - Add
@endsection

@section('section-warehouse')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
      <span class="text-muted fw-light">Inbound /</span> Add
    </h4>

    <!-- Property Listing Wizard -->
    <div id="wizard-property-listing" class="bs-stepper vertical mt-2 linear">
      <div class="bs-stepper-header" style="display: inline">
        <div class="step active" data-target="#personal-details">
          <button type="button" class="step-trigger" aria-selected="true">
            <span class="bs-stepper-circle"><i class="ti ti-box ti-sm"></i></span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Product Details</span>
              <span class="bs-stepper-subtitle">Product Type</span>
            </span>
          </button>
        </div>
      </div>

      <div class="bs-stepper-content">
        <form id="wizard-inbound-listing-form" action="{{ route('warehouse.inbound.store', $warehouse->id) }}" onsubmit="return false" enctype="multipart/form-data" method="POST" class="form-submit-inbound">
            @csrf
          <!-- Personal Details -->
          <div id="personal-details" class="content active dstepper-block fv-plugins-bootstrap5 fv-plugins-framework">
            <div class="row g-3">
                <div class="col-sm-6 fv-plugins-icon-container">
                    <label class="form-label" for="product_id">Product</label>
                    <div class="position-relative">
                        <select id="product_id" name="product_id" class="select2 form-select select2-hidden-accessible @error('product_id') is-invalid @enderror" data-allow-clear="true" data-select2-id="product_id" tabindex="-1" aria-hidden="true">
                            <option value="">Select Product</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}" {{ old('product_id') == $product->id ? 'selected' : '' }}>{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('product_id')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-6 fv-plugins-icon-container">
                    <label class="form-label" for="supplier_id">Supplier</label>
                    <div class="position-relative">
                        <select id="supplier_id" name="supplier_id" class="select2 form-select select2-hidden-accessible @error('supplier_id') is-invalid @enderror" data-allow-clear="true" data-select2-id="supplier_id" tabindex="-1" aria-hidden="true">
                            <option value="">Select Rack</option>
                            @foreach ($suppliers as $supplier)
                                <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>{{ $supplier->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('supplier_id')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-6 fv-plugins-icon-container">
                    <label class="form-label" for="code">Code</label>
                    <div class="position-relative">
                        <input type="text" id="code" name="code" class="form-control @error('code') is-invalid @enderror" placeholder="2204202400001" value="{{ old('code') }}">
                    </div>
                    @error('code')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-6 fv-plugins-icon-container">
                    <label class="form-label" for="price">Price</label>
                    <div class="position-relative">
                        <input type="text" id="price" name="price" class="form-control @error('price') is-invalid @enderror" placeholder="100.000" value="{{ old('price') }}">
                    </div>
                    @error('price')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-6 fv-plugins-icon-container">
                    <label class="form-label" for="on_hand">Stock On Hand</label>
                    <div class="position-relative">
                        <input type="number" id="on_hand" name="on_hand" min="1" class="form-control @error('on_hand') is-invalid @enderror" placeholder="10" value="{{ old('on_hand') }}">
                    </div>
                    @error('on_hand')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-6 fv-plugins-icon-container">
                    <label class="form-label" for="received_at">Received At</label>
                    <div class="position-relative">
                        <input type="datetime-local" id="received_at" name="received_at" class="form-control @error('received_at') is-invalid @enderror" min="1" value="{{ old('received_at', Carbon\Carbon::now()->format('Y-m-d\TH:i')) }}">
                    </div>
                    @error('received_at')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 d-flex justify-content-between mt-4">
                    <button class="btn btn-success btn-submit waves-effect waves-light btn-submit-inbound">
                        <span class="align-middle d-sm-inline-block d-none me-sm-1">Submit</span><i class="ti ti-check ti-xs"></i>
                    </button>
                </div>
            </div>
          </div>
          
        </form>
      </div>
    </div>
    <!--/ Property Listing Wizard -->
</div>
@endSection
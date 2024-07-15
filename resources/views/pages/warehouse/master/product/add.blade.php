@extends('layouts.warehouse')

@section('title')
    Master - Add Product
@endsection

@section('section-warehouse')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
      <span class="text-muted fw-light">Product /</span> Add
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
        <div class="line"></div>
        <div class="step" data-target="#property-details">
          <button type="button" class="step-trigger" aria-selected="false" disabled="disabled">
            <span class="bs-stepper-circle"><i class="ti ti-currency-dollar ti-sm"></i></span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Price Details</span>
              <span class="bs-stepper-subtitle">Expected Price</span>
            </span>
          </button>
        </div>
        <div class="line"></div>
        <div class="step" data-target="#property-features">
          <button type="button" class="step-trigger" aria-selected="false" disabled="disabled">
            <span class="bs-stepper-circle"><i class="ti ti-bookmarks ti-sm"></i></span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">About Product</span>
              <span class="bs-stepper-subtitle">Other Details</span>
            </span>
          </button>
        </div>
      </div>

      <div class="bs-stepper-content">
        <form id="wizard-product-listing-form" action="{{ route('warehouse.products.store', $warehouse->id) }}" onsubmit="return false" enctype="multipart/form-data" method="POST" class="form-submit-product">
            @csrf
          <!-- Personal Details -->
          <div id="personal-details" class="content active dstepper-block fv-plugins-bootstrap5 fv-plugins-framework">
            <div class="row g-3">
                <div class="col-sm-12 fv-plugins-icon-container">
                    <label class="form-label" for="name">Product Name</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Chair" value="{{ old('name') }}">
                    @error('name')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-6 fv-plugins-icon-container">
                    <label class="form-label" for="product_category_id">Category</label>
                    <div class="position-relative">
                        <select id="product_category_id" name="product_category_id" class="select2 form-select select2-hidden-accessible @error('product_category_id') is-invalid @enderror" data-allow-clear="true" data-select2-id="product_category_id" tabindex="-1" aria-hidden="true">
                            <option value="">Select Product Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" {{ old('product_category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('product_category_id')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-6 fv-plugins-icon-container">
                    <label class="form-label" for="rack_id">Rack</label>
                    <div class="position-relative">
                        <select id="rack_id" name="rack_id" class="select2 form-select select2-hidden-accessible @error('rack_id') is-invalid @enderror" data-allow-clear="true" data-select2-id="rack_id" tabindex="-1" aria-hidden="true">
                            <option value="">Select Rack</option>
                            @foreach ($racks as $rack)
                                <option value="{{ $rack->id }}" {{ old('rack_id') == $rack->id ? 'selected' : '' }}>{{ $rack->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('rack_id')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-12">
                    <label class="form-label" for="description">Description <span><span class="text-danger"><sup>*Optional</sup></span></span></label>
                    <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="5" placeholder="Lorem ipsum dolor sit amet">{{ old('description') }}</textarea>
                    @error('description')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-12">
                    <label class="form-label" for="image1">Image 1</label>
                    <input type="file" class="form-control" name="product_image[]" id="image1" onchange="previewImageProduct(1)">
                    <img class="mt-3 img-preview1 w-25">
                </div>
                <div class="col-lg-12">
                    <label class="form-label" for="image2">Image 2</label>
                    <input type="file" class="form-control" name="product_image[]" id="image2" onchange="previewImageProduct(2)">
                    <img class="mt-3 img-preview2 w-25">
                </div>
                <div class="col-lg-12">
                    <label class="form-label" for="image3">Image 3</label>
                    <input type="file" class="form-control" name="product_image[]" id="image3" onchange="previewImageProduct(3)">
                    <img class="mt-3 img-preview3 w-25">
                </div>
                <div class="col-lg-12">
                    <label class="form-label" for="image4">Image 4</label>
                    <input type="file" class="form-control" name="product_image[]" id="image4" onchange="previewImageProduct(4)">
                    <img class="mt-3 img-preview4 w-25">
                </div>
                <div class="col-lg-12">
                    <label class="form-label" for="image5">Image 5</label>
                    <input type="file" class="form-control" name="product_image[]" id="image5" onchange="previewImageProduct(5)">
                    <img class="mt-3 img-preview5 w-25">
                </div>
                <div class="col-12 d-flex justify-content-between mt-4">
                    <button class="btn btn-label-secondary btn-prev waves-effect" disabled="">
                        <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                    </button>
                    <button class="btn btn-primary btn-next waves-effect waves-light">
                        <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                        <i class="ti ti-arrow-right ti-xs"></i>
                    </button>
                </div>
            </div>
          </div>

          <!-- Property Details -->
          <div id="property-details" class="content fv-plugins-bootstrap5 fv-plugins-framework">
            <div class="row g-3">
                <div class="col-sm-12 fv-plugins-icon-container">
                    <label class="form-label" for="sale_price">Sale Price</label>
                    <input type="text" id="sale_price" name="sale_price" class="form-control @error('sale_price') is-invalid @enderror" value="{{ old('sale_price') }}">
                    @error('sale_price')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 d-flex justify-content-between mt-4">
                    <button class="btn btn-label-secondary btn-prev waves-effect">
                        <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                    </button>
                    <button class="btn btn-primary btn-next waves-effect waves-light">
                        <span class="align-middle d-sm-inline-block d-none me-sm-1">Next</span>
                        <i class="ti ti-arrow-right ti-xs"></i>
                    </button>
                </div>
            </div>
          </div>

          <!-- Property Features -->
          <div id="property-features" class="content fv-plugins-bootstrap5 fv-plugins-framework">
            <div class="row g-3">
                <div class="col-sm-4 fv-plugins-icon-container">
                    <label class="form-label" for="weight">Weight (Gram)</label>
                    <input type="number" id="weight" name="weight" class="form-control @error('weight') is-invalid @enderror" placeholder="100" value="{{ old('weight') }}" min="1">
                    @error('weight')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-4 fv-plugins-icon-container">
                    <label class="form-label" for="length">Length (CM) <sup><span class="text-danger">*Optional</span></sup></label>
                    <input type="text" id="length" name="length" class="form-control @error('length') is-invalid @enderror" placeholder="100" value="{{ old('length') }}">
                    @error('length')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-4 fv-plugins-icon-container">
                    <label class="form-label" for="dimension">Width (CM) <sup><span class="text-danger">*Optional</span></sup></label>
                    <input type="text" id="width" name="width" class="form-control @error('width') is-invalid @enderror" placeholder="100" value="{{ old('width') }}">
                    @error('width')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-4 fv-plugins-icon-container">
                    <label class="form-label" for="height">Height (CM) <sup><span class="text-danger">*Optional</span></sup></label>
                    <input type="text" id="height" name="height" class="form-control @error('height') is-invalid @enderror" placeholder="100" value="{{ old('height') }}">
                    @error('height')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-4 fv-plugins-icon-container">
                    <label class="form-label" for="expired_date">Expired Date <sup><span class="text-danger">*Optional</span></sup></label>
                    <input type="date" id="expired_date" name="expired_date" class="form-control @error('expired_date') is-invalid @enderror" value="{{ old('expired_date') }}">
                    @error('expired_date')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-12 d-flex justify-content-between mt-4">
                    <button class="btn btn-label-secondary btn-prev waves-effect">
                        <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                        <span class="align-middle d-sm-inline-block d-none">Previous</span>
                    </button>
                    <button class="btn btn-success btn-submit btn-next waves-effect waves-light">
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
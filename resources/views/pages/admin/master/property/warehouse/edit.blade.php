@extends('layouts.admin')

@section('title')
    Master - Edit Warehouse
@endsection

@section('section-admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Property / Edit Warehouse /</span> {{ $warehouse->name }}
    </h4>

    <!-- Property Listing Wizard -->
    <div id="wizard-property-listing" class="bs-stepper vertical mt-2 linear">
      <div class="bs-stepper-header">
        <div class="step active" data-target="#personal-details">
          <button type="button" class="step-trigger" aria-selected="true">
            <span class="bs-stepper-circle"><i class="ti ti-home ti-sm"></i></span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Property Details</span>
              <span class="bs-stepper-subtitle">Property Type</span>
            </span>
          </button>
        </div>
        <div class="line"></div>
        <div class="step" data-target="#property-details">
          <button type="button" class="step-trigger" aria-selected="false" disabled="disabled">
            <span class="bs-stepper-circle"><i class="ti ti-map-pin ti-sm"></i></span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Property Area</span>
              <span class="bs-stepper-subtitle">Covered Area</span>
            </span>
          </button>
        </div>
        <div class="line"></div>
        <div class="step" data-target="#property-features">
          <button type="button" class="step-trigger" aria-selected="false" disabled="disabled">
            <span class="bs-stepper-circle"><i class="ti ti-bookmarks ti-sm"></i></span>
            <span class="bs-stepper-label">
              <span class="bs-stepper-title">Property Features</span>
              <span class="bs-stepper-subtitle">Bedrooms/Floor No</span>
            </span>
          </button>
        </div>
      </div>

      <div class="bs-stepper-content">
        <form id="wizard-property-listing-form" action="{{ route('master.warehouse.update', $warehouse->id) }}" onsubmit="return false" enctype="multipart/form-data" method="POST" class="form-submit-warehouse">
            @csrf
            @method('PATCH')
          <!-- Personal Details -->
          <div id="personal-details" class="content active dstepper-block fv-plugins-bootstrap5 fv-plugins-framework">
            <div class="row g-3">
                <div class="col-sm-6 fv-plugins-icon-container">
                    <label class="form-label" for="name">Warehouse Name</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Evergreen Distribution Center" value="{{ old('name', $warehouse->name) }}">
                    @error('name')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-6 fv-plugins-icon-container">
                    <label class="form-label" for="warehouse_category_id">Warehouse Type</label>
                    <div class="position-relative">
                        <select id="warehouse_category_id" name="warehouse_category_id" class="select2 form-select select2-hidden-accessible @error('warehouse_category_id') is-invalid @enderror" data-allow-clear="true" data-select2-id="warehouse_category_id" tabindex="-1" aria-hidden="true">
                            <option value="">Select Warehouse Type</option>
                            @foreach ($warehouse_categories as $category)
                                <option value="{{ $category->id }}" {{ old('warehouse_category_id', $warehouse->warehouse_category_id) == $category->id ? 'selected' : '' }}>{{ $category->category }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('warehouse_category_id')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-4 fv-plugins-icon-container">
                    <label class="form-label" for="country_id">Country</label>
                    <div class="position-relative">
                        <select id="country_id" name="country_id" class="select2 form-select select2-hidden-accessible @error('country_id') is-invalid @enderror" data-allow-clear="true" data-select2-id="country_id" tabindex="-1" aria-hidden="true">
                            <option value="">Select Country</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}" {{ old('country_id', $warehouse->country_id) == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('country_id')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-4">
                    <label class="form-label" for="city">City</label>
                    <input type="text" id="city" name="city" class="form-control @error('city') is-invalid @enderror" placeholder="New York" value="{{ old('city', $warehouse->city) }}">
                    @error('city')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-4 fv-plugins-icon-container">
                    <label class="form-label" for="zip_code">Zip Code</label>
                    <input type="number" id="zip_code" name="zip_code" class="form-control @error('zip_code') is-invalid @enderror" placeholder="99950" value="{{ old('zip_code', $warehouse->zip_code) }}">
                    @error('zip_code')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-12">
                    <label class="form-label" for="address">Address</label>
                    <textarea id="address" name="address" class="form-control @error('address') is-invalid @enderror" rows="5" placeholder="12, Business Park">{{ old('address', $warehouse->address) }}</textarea>
                    @error('address')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                @php
                    $mediaUrls = [];
                    $mediaUuid = [];
                    $mediaCollection = $warehouse->getMedia('warehouse_images');

                    foreach ($mediaCollection as $media) {
                        $mediaUrls[] = $media->getUrl();
                        $mediaUuid[] = $media->uuid;
                    }
                @endphp

                <div class="col-lg-12">
                    <label class="form-label" for="image1">Image 1</label>
                    <input type="file" class="form-control" name="warehouse_image_one" id="image1" onchange="previewImageWarehouse(1); fillUpWarehouseImageUUID(1, '{{ !empty($mediaUuid[0]) ?? '' }}')">
                    <input type="hidden" name="warehouse_image_uuid[]" id="warehouse_image_uuid_1">
                    @if (!empty($mediaUrls[0]))
                        <img src="{{ $mediaUrls[0] }}" class="mt-3 img-preview1 w-25">
                    @endif
                    @error('warehouse_image_one')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-12">
                    <label class="form-label" for="image2">Image 2</label>
                    <input type="file" class="form-control" name="warehouse_image_two" id="image2" onchange="previewImageWarehouse(2); fillUpWarehouseImageUUID(2, '{{ !empty($mediaUuid[1]) ?? '' }}')">
                    <input type="hidden" name="warehouse_image_uuid[]" id="warehouse_image_uuid_2">
                    @if (!empty($mediaUrls[1]))
                        <img src="{{ $mediaUrls[1] }}" class="mt-3 img-preview2 w-25">
                    @endif
                    @error('warehouse_image_two')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-12">
                    <label class="form-label" for="image3">Image 3</label>
                    <input type="file" class="form-control" name="warehouse_image_three" id="image3" onchange="previewImageWarehouse(3); fillUpWarehouseImageUUID(3, '{{ !empty($mediaUuid[2]) }}')">
                    <input type="hidden" name="warehouse_image_uuid[]" id="warehouse_image_uuid_3">
                    @if (!empty($mediaUrls[2]))
                        <img src="{{ $mediaUrls[2] }}" class="mt-3 img-preview3 w-25">
                    @endif
                    @error('warehouse_image_three')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-12">
                    <label class="form-label" for="image4">Image 4</label>
                    <input type="file" class="form-control" name="warehouse_image_four" id="image4" onchange="previewImageWarehouse(4); fillUpWarehouseImageUUID(4, '{{ !empty($mediaUuid[3]) ?? '' }}')">
                    <input type="hidden" name="warehouse_image_uuid[]" id="warehouse_image_uuid_4">
                    @if (!empty($mediaUrls[3]))
                        <img src="{{ $mediaUrls[3] }}" class="mt-3 img-preview4 w-25">
                    @endif
                    @error('warehouse_image_four')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-12">
                    <label class="form-label" for="image5">Image 5</label>
                    <input type="file" class="form-control" name="warehouse_image_five" id="image5" onchange="previewWarehouseProduct(5); fillUpWarehouseImageUUID(5, '{{ !empty($mediaUuid[4]) ?? '' }}')">
                    <input type="hidden" name="warehouse_image_uuid[]" id="warehouse_image_uuid_5">
                    @if (!empty($mediaUrls[4]))
                        <img src="{{ $mediaUrls[4] }}" class="mt-3 img-preview5 w-25">
                    @endif
                    @error('warehouse_image_five')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
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
                <div class="col-sm-4 fv-plugins-icon-container">
                    <label class="form-label" for="capacity">Capacity Volume <span>(m<sup>3</sup>)</span></label>
                    <input type="number" id="capacity" name="capacity" class="form-control @error('capacity') is-invalid @enderror" placeholder="100" value="{{ old('capacity', $warehouse->capacity) }}">
                    @error('capacity')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-4 fv-plugins-icon-container">
                    <label class="form-label" for="surface_area">Surface Area <span>(m<sup>3</sup>)</span></label>
                    <input type="number" id="surface_area" name="surface_area" class="form-control @error('surface_area') is-invalid @enderror" placeholder="100" value="{{ old('surface_area', $warehouse->surface_area) }}">
                    @error('surface_area')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-4 fv-plugins-icon-container">
                    <label class="form-label" for="building_area">Building Area <span>(m<sup>3</sup>)</span></label>
                    <input type="number" id="building_area" name="building_area" class="form-control @error('building_area') is-invalid @enderror" placeholder="100" value="{{ old('building_area', $warehouse->building_area) }}">
                    @error('building_area')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-lg-12">
                    <label class="form-label" for="description">Description <span class="text-danger"><sup>*Optional</sup></span></label>
                    <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="10" placeholder="Lorem ipsum dolor sit amet">{{ old('description', $warehouse->description) }}</textarea>
                    @error('description')
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
                <div class="col-sm-6 fv-plugins-icon-container">
                    <label class="form-label" for="storage_shelves">Storage Shelves</label>
                    <input type="number" id="storage_shelves" name="storage_shelves" class="form-control @error('storage_shelves') is-invalid @enderror" placeholder="50" value="{{ old('storage_shelves', $warehouse->storage_shelves) }}">
                    @error('storage_shelves')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-6 fv-plugins-icon-container">
                    <label class="form-label" for="toilet_and_rest_area">Toilet or Rest Area</label>
                    <input type="number" id="toilet_and_rest_area" name="toilet_and_rest_area" class="form-control @error('toilet_and_rest_area') is-invalid @enderror" placeholder="50" value="{{ old('toilet_and_rest_area', $warehouse->toilet_and_rest_area) }}">
                    @error('toilet_and_rest_area')
                        <div class="fv-plugins-message-container invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <label class="form-label">Lightning System ?</label>
                    <div class="form-check mb-2">
                      <input class="form-check-input" type="radio" name="effective_lighting_system" id="effective_lighting_system_yes" value="yes" {{ old('effective_lighting_system', $warehouse->effective_lighting_system) == 'yes' ? 'checked' : '' }}>
                      <label class="form-check-label" for="effective_lighting_system_yes">Yes</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="effective_lighting_system" id="effective_lighting_system_no" value="no" {{ old('effective_lighting_system', $warehouse->effective_lighting_system) == 'no' ? 'checked' : '' }}>
                      <label class="form-check-label" for="effective_lighting_system_no">No</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label class="form-label">Security System ?</label>
                    <div class="form-check mb-2">
                      <input class="form-check-input" type="radio" name="advanced_security_system" id="advanced_security_system_yes" value="yes" {{ old('advanced_security_system', $warehouse->advanced_security_system) == 'yes' ? 'checked' : '' }}>
                      <label class="form-check-label" for="advanced_security_system_yes">Yes</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="advanced_security_system" id="advanced_security_system_no" value="no" {{ old('advanced_security_system', $warehouse->advanced_security_system) == 'no' ? 'checked' : '' }}>
                      <label class="form-check-label" for="advanced_security_system_no">No</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label class="form-label">Electricy ?</label>
                    <div class="form-check mb-2">
                      <input class="form-check-input" type="radio" name="electricity" id="electricity_yes" value="yes" {{ old('electricity', $warehouse->electricity) == 'yes' ? 'checked' : '' }}>
                      <label class="form-check-label" for="electricity_yes">Yes</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="electricity" id="electricity_no" value="no" {{ old('electricity', $warehouse->electricity) == 'no' ? 'checked' : '' }}>
                      <label class="form-check-label" for="electricity_no">No</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label class="form-label">Administrative Room Or Office ?</label>
                    <div class="form-check mb-2">
                      <input class="form-check-input" type="radio" name="administrative_room_or_office" id="administrative_room_or_office_yes" value="yes" {{ old('administrative_room_or_office', $warehouse->administrative_room_or_office) == 'yes' ? 'checked' : '' }}>
                      <label class="form-check-label" for="administrative_room_or_office_yes">Yes</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="administrative_room_or_office" id="administrative_room_or_office_no" value="no" {{ old('administrative_room_or_office', $warehouse->administrative_room_or_office) == 'no' ? 'checked' : '' }}>
                      <label class="form-check-label" for="administrative_room_or_office_no">No</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label class="form-label">Worker Safety Equipment ?</label>
                    <div class="form-check mb-2">
                      <input class="form-check-input" type="radio" name="worker_safety_equipment" id="worker_safety_equipment_yes" value="yes" {{ old('worker_safety_equipment', $warehouse->worker_safety_equipment) == 'yes' ? 'checked' : '' }}>
                      <label class="form-check-label" for="worker_safety_equipment_yes">Yes</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="worker_safety_equipment" id="worker_safety_equipment_no" value="no" {{ old('worker_safety_equipment', $warehouse->worker_safety_equipment) == 'no' ? 'checked' : '' }}>
                      <label class="form-check-label" for="worker_safety_equipment_no">No</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <label class="form-label">Firefighting Tools ?</label>
                    <div class="form-check mb-2">
                      <input class="form-check-input" type="radio" name="firefighting_tools" id="firefighting_tools_yes" value="yes" {{ old('firefighting_tools', $warehouse->firefighting_tools) == 'yes' ? 'checked' : '' }}>
                      <label class="form-check-label" for="firefighting_tools_yes">Yes</label>
                    </div>
                    <div class="form-check">
                      <input class="form-check-input" type="radio" name="firefighting_tools" id="firefighting_tools_no" value="no" {{ old('firefighting_tools', $warehouse->firefighting_tools) == 'no' ? 'checked' : '' }}>
                      <label class="form-check-label" for="firefighting_tools_no">No</label>
                    </div>
                </div>
                <div class="col-lg-12">
                    <label class="form-label" for="goods_handling_equipment">Goods Handling Equipment <span class="text-danger"><sup>*Optional</sup></span></label>
                    <input id="goods_handling_equipment" name="goods_handling_equipment" class="form-control" placeholder="select options" tabindex="-1" value="{{ old('goods_handling_equipment', $warehouse->goods_handling_equipment) }}">
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
@endsection
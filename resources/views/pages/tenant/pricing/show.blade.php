@extends('layouts.tenant')

@section('title')
    Pricing - Details
@endsection

@section('section-tenant')
<style>
table tr th, td {
    padding-top: 1rem; 
}

table tr th {
    width: 10rem;
}
</style>

<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <!-- Navigation -->
        <div class="col-lg-3 col-md-4 col-12 mb-md-0 mb-3">
          <div class="d-flex justify-content-between flex-column mb-2 mb-md-0">
            <ul class="nav nav-align-left nav-pills flex-column" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#payment" aria-selected="true" role="tab">
                  <i class="ti ti-building me-1 ti-sm"></i>
                  <span class="align-middle fw-semibold">Property</span>
                </button>
              </li>
              {{-- <li class="nav-item" role="presentation">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#delivery" aria-selected="false" tabindex="-1" role="tab">
                  <i class="ti ti-briefcase me-1 ti-sm"></i>
                  <span class="align-middle fw-semibold">Subscription</span>
                </button>
              </li> --}}
            </ul>
          </div>
        </div>
        <!-- /Navigation -->

        <!-- FAQ's -->
        <div class="col-lg-9 col-md-8 col-12">
          <div class="tab-content py-0">
            <div class="tab-pane fade show active" id="payment" role="tabpanel">
              <div class="d-flex mb-3 gap-3">
                <div>
                  <span class="badge bg-label-primary rounded-2 p-2">
                    <i class="ti ti-building ti-lg"></i>
                  </span>
                </div>
                <div>
                  <h4 class="mb-0">
                    <span class="align-middle">Property</span>
                  </h4>
                  <small>Showing All Property Details</small>
                </div>
              </div>
              <div id="accordionPayment" class="accordion">
                <div class="card accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" aria-expanded="true" data-bs-target="#accordionPayment-1" aria-controls="accordionPayment-1">
                      Property Type
                    </button>
                  </h2>

                  <div id="accordionPayment-1" class="accordion-collapse collapse show">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="swiper swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden" id="swiper-with-progress">
                                    <div class="swiper-wrapper" id="swiper-wrapper-10dbce8a9e6f82cf1" aria-live="polite" style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);">
                                      @foreach ($warehouse->getMedia('warehouse_images') as $media)
                                        <div class="swiper-slide" style="background-image: url({{ $media->getUrl() }})" role="group"></div>
                                      @endforeach
                                    </div>
                                    <div class="swiper-pagination swiper-pagination-progressbar swiper-pagination-horizontal"><span class="swiper-pagination-progressbar-fill" style="transform: translate3d(0px, 0px, 0px) scaleX(0.4) scaleY(1); transition-duration: 300ms;"></span></div>
                                    <div class="swiper-button-next swiper-button-white custom-icon" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-10dbce8a9e6f82cf1" aria-disabled="false"></div>
                                    <div class="swiper-button-prev swiper-button-white custom-icon" tabindex="0" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-10dbce8a9e6f82cf1" aria-disabled="false"></div>
                                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <table style="width:100%">
                                    <tr>
                                      <th>Name:</th>
                                      <td>{{ $warehouse->name }}</td>
                                    </tr>
                                    <tr>
                                      <th>Category:</th>
                                      <td>{{ $warehouse->warehouse_category->category }}</td>
                                    </tr>
                                    <tr>
                                      <th>City:</th>
                                      <td>{{ $warehouse->city }}</td>
                                    </tr>
                                    <tr>
                                      <th>Address:</th>
                                      <td>{{ $warehouse->address }}</td>
                                    </tr>
                                    <tr>
                                      <th>Zip Code:</th>
                                      <td>{{ $warehouse->zip_code }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>

                <div class="card accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionPayment-2" aria-controls="accordionPayment-2">
                      Covered Area
                    </button>
                  </h2>
                  <div id="accordionPayment-2" class="accordion-collapse collapse">
                    <div class="accordion-body">
                      <table style="width:100%">
                        <tr>
                          <th>Capacity:</th>
                          <td>{{ $warehouse->capacity }} <span>m<sup>3</sup></span></td>
                        </tr>
                        <tr>
                          <th>Building Area:</th>
                          <td>{{ $warehouse->building_area }} <span>m<sup>3</sup></span></td>
                        </tr>
                        <tr>
                          <th>Surface Area:</th>
                          <td>{{ $warehouse->surface_area }} <span>m<sup>3</sup></span></td>
                        </tr>
                    </table>
                    </div>
                  </div>
                </div>

                <div class="card accordion-item">
                  <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accordionPayment-3" aria-controls="accordionPayment-3">
                      Storage Features
                    </button>
                  </h2>
                  <div id="accordionPayment-3" class="accordion-collapse collapse">
                    <div class="accordion-body">
                      <div class="row">
                        <div class="col-md-6">
                          <table style="width:100%">
                            <tr>
                              <th>Storage Shelves:</th>
                              <td>{{ $warehouse->storage_shelves }}</td>
                            </tr>
                            <tr>
                              <th>Toilet or Rest Area:</th>
                              <td>{{ $warehouse->toilet_and_rest_area }}</td>
                            </tr>
                          </table>
                        </div>
                        <div class="col-md-6">
                          <table style="width:100%">
                            <tr>
                              <th>Lightning System:</th>
                              <td><span class="text-capitalize">{{ $warehouse->effective_lighting_system }}</span></td>
                            </tr>
                            <tr>
                              <th>Security System:</th>
                              <td><span class="text-capitalize">{{ $warehouse->advanced_security_system }}</span></td>
                            </tr>
                          </table>
                        </div>
                        <div class="col-md-6">
                          <table style="width:100%">
                            <tr>
                              <th>Electricity:</th>
                              <td> <span class="text-capitalize">{{ $warehouse->electricity }}</span></td>
                            </tr>
                            <tr>
                              <th>Administrative Room Or Office:</th>
                              <td><span class="text-capitalize">{{ $warehouse->administrative_room_or_office }}</span></td>
                            </tr>
                          </table>
                        </div>
                        <div class="col-md-6">
                          <table style="width:100%">
                            <tr>
                              <th>Worker Safety Equipment:</th>
                              <td><span class="text-capitalize">{{ $warehouse->worker_safety_equipment }}</span></td>
                            </tr>
                            <tr>
                              <th>Firefighting Tools:</th>
                              <td><span class="text-capitalize">{{ $warehouse->firefighting_tools }}</span></td>
                            </tr>
                          </table>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <table style="width:100%">
                            <tr>
                              <th>Goods Handling Equipment:</th>
                              <td>
                                <span class="text-capitalize">
                                  <ul>
                                    @if (!is_null($warehouse->goods_handling_equipment))
                                    @foreach (json_decode($warehouse->goods_handling_equipment, true) as $key => $item)
                                        <li>{{ $item['value'] }}</li>
                                    @endforeach
                                    @else
                                      Empty
                                    @endif
                                  </ul>
                                </span>
                              </td>
                            </tr>
                          </table>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        <!-- /FAQ's -->
    </div>
</div>
@endsection
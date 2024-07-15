@extends('layouts.tenant')

@section('title')
    Cart - Page
@endsection

@section('section-tenant')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Shopping Cart /</span> Checkout</h4>
    <!-- Checkout Wizard -->
    <div id="shopping-cart-card" class="bs-stepper wizard-icons wizard-icons-example mt-2">
      <div class="bs-stepper-content border-top">
        <form id="form-submit-checkout" action="{{ route('shopping.cart.store') }}" method="POST">
            @csrf
            <div id="checkout-cart" class="content fv-plugins-bootstrap5 fv-plugins-framework active dstepper-block">
                <div class="row">
                <!-- Cart left -->
                <div class="col-xl-8 mb-3 mb-xl-0">

                    <!-- Shopping bag -->
                    <h5>My Shopping Cart ({{ $carts->count() }} {{ $carts->count() > 1 ? 'items' : 'item' }})</h5>
                    <ul class="list-group mb-3">
                        @foreach ($carts as $cart)
                        <li class="list-group-item p-4">
                            <div class="d-flex gap-3">
                                <div>
                                    <img src="{{ $cart->warehouse->getFirstMediaUrl('warehouse_images') }}" alt="google home" class="w-px-100">
                                </div>
                                <div class="flex-grow-1">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <a href="javascript:void(0)" class="text-body">{{ $cart->warehouse->name }}</a>
                                            <div class="text-muted mb-2 mt-3 d-flex flex-wrap">
                                                <span class="me-1">Subscription:</span>
                                                <select id="warehouse_subscription_id" class="form-select w-50 ms-2" data-id="{{ $cart->id }}">
                                                    @foreach ($cart->warehouse->warehouse_subscription->sortBy('subscription.month_duration') as $warehouse_subscription)
                                                        <option value="{{ $warehouse_subscription->id }}" data-warehouse-id="{{ $cart->warehouse->id }}" {{ $cart->warehouse_subscription_id == $warehouse_subscription->id ? 'selected' : '' }}>{{ $warehouse_subscription->subscription->name }} | @convertMonthsToYearsAndMonths($warehouse_subscription->subscription->month_duration)</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <span class="text-body">Address : {{ $cart->warehouse->address }}</span>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="text-md-end">
                                                <button type="button" class="btn-close btn-pinned" aria-label="Close" id="button-delete-shopping-cart" data-id="{{ $cart->id }}"></button>
                                                <div class="my-2 my-md-4 mb-md-5">
                                                    <span class="text-primary">@rupiah($cart->subtotal)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        @endforeach
                    </ul>

                    <div class="list-group">
                    <a href="{{ route('pricing.index', 'all') }}" class="list-group-item d-flex justify-content-between">
                        <span>Add more warehouse from pricing</span>
                        <i class="ti ti-sm ti-chevron-right scaleX-n1-rtl"></i>
                    </a>
                    </div>
                </div>

                <!-- Cart right -->
                <div class="col-xl-4">
                    <div class="border rounded p-4 mb-3 pb-3">

                    <!-- Price Details -->
                        <h6>Price Details</h6>
                        <dl class="row mb-0">
                            <dt class="col-6 fw-normal">Subtotal</dt>
                            <dd class="col-6 text-end">@rupiah($carts->sum('subtotal'))</dd>

                            <dt class="col-6 fw-normal">Application Charges ({{ $tax->value }}%)</dt>
                            <dd class="col-6 text-end">@rupiah($carts->sum('subtotal') * $tax->value / 100)</dd>
                        </dl>

                        <hr class="mx-n4">
                        <dl class="row mb-0">
                            <dt class="col-6">Total</dt>
                            <dd class="col-6 fw-semibold text-end mb-0">@rupiah($carts->sum('subtotal') + $carts->sum('subtotal') * $tax->value / 100)</dd>
                        </dl>
                    </div>
                    @if ($carts->count() > 0 && \App\Models\Rented::whereIn('warehouse_id', $warehouse_ids)->count() == 0)
                    <div class="d-grid">
                      <button class="btn btn-primary btn-next waves-effect waves-light">Place Order</button>
                    </div>
                    @elseif ($carts->count() && \App\Models\Rented::whereIn('warehouse_id', $warehouse_ids)->count())
                    <div class="d-grid">
                      <a href="javascript:void(0)" class="btn btn-secondary btn-next waves-effect waves-light">Can't Place Order</a>
                    </div>
                    @endif
                </div>
                </div>
            </div>

          <!-- Payment -->
          {{-- <div id="checkout-payment" class="content fv-plugins-bootstrap5 fv-plugins-framework">
            <div class="row">
              <!-- Payment left -->
              <div class="col-xl-9 mb-3 mb-xl-0">
                <!-- Offer alert -->
                <div class="alert alert-success" role="alert">
                  <div class="d-flex gap-3">
                    <div class="flex-shrink-0">
                      <i class="ti ti-bookmarks ti-sm alert-icon alert-icon-lg"></i>
                    </div>
                    <div class="flex-grow-1">
                      <div class="fw-semibold mb-2">Bank Offers</div>
                      <ul class="list-unstyled mb-0">
                        <li>- 10% Instant Discount on Bank of America Corp Bank Debit and Credit cards</li>
                      </ul>
                    </div>
                  </div>
                  <button type="button" class="btn-close btn-pinned" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

                <!-- Payment Tabs -->
                <div class="col-xxl-6 col-lg-8">
                  <ul class="nav nav-pills mb-3" id="paymentTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                      <button class="nav-link active" id="pills-cc-tab" data-bs-toggle="pill" data-bs-target="#pills-cc" type="button" role="tab" aria-controls="pills-cc" aria-selected="true">
                        Card
                      </button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-cod-tab" data-bs-toggle="pill" data-bs-target="#pills-cod" type="button" role="tab" aria-controls="pills-cod" aria-selected="false" tabindex="-1">
                        Cash On Delivery
                      </button>
                    </li>
                    <li class="nav-item" role="presentation">
                      <button class="nav-link" id="pills-gift-card-tab" data-bs-toggle="pill" data-bs-target="#pills-gift-card" type="button" role="tab" aria-controls="pills-gift-card" aria-selected="false" tabindex="-1">
                        Gift Card
                      </button>
                    </li>
                  </ul>
                  <div class="tab-content px-0" id="paymentTabsContent">
                    <!-- Credit card -->
                    <div class="tab-pane fade show active" id="pills-cc" role="tabpanel" aria-labelledby="pills-cc-tab">
                      <div class="row g-3">
                        <div class="col-12">
                          <label class="form-label w-100" for="paymentCard">Card Number</label>
                          <div class="input-group input-group-merge">
                            <input id="paymentCard" name="paymentCard" class="form-control credit-card-mask" type="text" placeholder="1356 3215 6548 7898" aria-describedby="paymentCard2">
                            <span class="input-group-text cursor-pointer p-1" id="paymentCard2"><span class="card-type"></span></span>
                          </div>
                        </div>
                        <div class="col-12 col-md-6">
                          <label class="form-label" for="paymentCardName">Name</label>
                          <input type="text" id="paymentCardName" class="form-control" placeholder="John Doe">
                        </div>
                        <div class="col-6 col-md-3">
                          <label class="form-label" for="paymentCardExpiryDate">Exp. Date</label>
                          <input type="text" id="paymentCardExpiryDate" class="form-control expiry-date-mask" placeholder="MM/YY">
                        </div>
                        <div class="col-6 col-md-3">
                          <label class="form-label" for="paymentCardCvv">CVV Code</label>
                          <div class="input-group input-group-merge">
                            <input type="text" id="paymentCardCvv" class="form-control cvv-code-mask" maxlength="3" placeholder="654">
                            <span class="input-group-text cursor-pointer" id="paymentCardCvv2"><i class="ti ti-help text-muted" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Card Verification Value" data-bs-original-title="Card Verification Value"></i></span>
                          </div>
                        </div>
                        <div class="col-12">
                          <label class="switch">
                            <input type="checkbox" class="switch-input">
                            <span class="switch-toggle-slider">
                              <span class="switch-on"></span>
                              <span class="switch-off"></span>
                            </span>
                            <span class="switch-label">Save card for future billing?</span>
                          </label>
                        </div>
                        <div class="col-12">
                          <button type="button" class="btn btn-primary btn-next me-sm-3 me-1 waves-effect waves-light">Submit</button>
                          <button type="reset" class="btn btn-label-secondary waves-effect">Cancel</button>
                        </div>
                      </div>
                    </div>

                    <!-- COD -->
                    <div class="tab-pane fade" id="pills-cod" role="tabpanel" aria-labelledby="pills-cod-tab">
                      <p>
                        Cash on Delivery is a type of payment method where the recipient make payment for the
                        order at the time of delivery rather than in advance.
                      </p>
                      <button type="button" class="btn btn-primary btn-next waves-effect waves-light">Pay On Delivery</button>
                    </div>

                    <!-- Gift card -->
                    <div class="tab-pane fade" id="pills-gift-card" role="tabpanel" aria-labelledby="pills-gift-card-tab">
                      <h6>Enter Gift Card Details</h6>
                      <div class="row g-3">
                        <div class="col-12">
                          <label for="giftCardNumber" class="form-label">Gift card number</label>
                          <input type="number" class="form-control" id="giftCardNumber" placeholder="Gift card number">
                        </div>
                        <div class="col-12">
                          <label for="giftCardPin" class="form-label">Gift card pin</label>
                          <input type="number" class="form-control" id="giftCardPin" placeholder="Gift card pin">
                        </div>
                        <div class="col-12">
                          <button type="button" class="btn btn-primary btn-next waves-effect waves-light">Redeem Gift Card</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Address right -->
              <div class="col-xl-3">
                <div class="border rounded p-4">
                  <!-- Price Details -->
                  <h6>Price Details</h6>
                  <dl class="row">
                    <dt class="col-6 fw-normal">Order Total</dt>
                    <dd class="col-6 text-end">$1100.00</dd>

                    <dt class="col-6 fw-normal">Delivery Charges</dt>
                    <dd class="col-6 text-end">
                      <s>$5.00</s> <span class="badge bg-label-success ms-1">Free</span>
                    </dd>
                  </dl>
                  <hr class="mx-n4">
                  <dl class="row">
                    <dt class="col-6 mb-3">Total</dt>
                    <dd class="col-6 fw-semibold text-end mb-0">$1100.00</dd>

                    <dt class="col-6 fw-normal">Deliver to:</dt>
                    <dd class="col-6 fw-semibold text-end mb-0">
                      <span class="badge bg-label-primary">Home</span>
                    </dd>
                  </dl>
                  <!-- Address Details -->
                  <address class="text-heading">
                    <span> John Doe (Default),</span><br>
                    4135 Parkway Street, <br>
                    Los Angeles, CA, 90017. <br>
                    Mobile : +1 906 568 2332
                  </address>
                  <a href="javascript:void(0)">Change address</a>
                </div>
              </div>
            </div>
          </div> --}}

          <!-- Confirmation -->
          {{-- <div id="checkout-confirmation" class="content fv-plugins-bootstrap5 fv-plugins-framework">
            <div class="row mb-3">
              <div class="col-12 col-lg-8 offset-lg-2 text-center mb-3">
                <h4 class="mt-2">Thank You! 😇</h4>
                <p>Your order <a href="javascript:void(0)">#1536548131</a> has been placed!</p>
                <p>
                  We sent an email to <a href="mailto:john.doe@example.com">john.doe@example.com</a> with your
                  order confirmation and receipt. If the email hasn't arrived within two minutes, please check
                  your spam folder to see if the email was routed there.
                </p>
                <p>
                  <span class="fw-semibold"><i class="ti ti-clock me-1"></i> Time placed:</span> 25/05/2020
                  13:35pm
                </p>
              </div>
              <!-- Confirmation details -->
              <div class="col-12">
                <ul class="list-group list-group-horizontal-md">
                  <li class="list-group-item flex-fill p-4 text-heading">
                    <h6><i class="ti ti-map-pin"></i> Shipping</h6>
                    <address class="mb-0">
                      John Doe <br>
                      4135 Parkway Street,<br>
                      Los Angeles, CA 90017,<br>
                      USA
                    </address>
                    <p class="mb-0 mt-3">+123456789</p>
                  </li>
                  <li class="list-group-item flex-fill p-4 text-heading">
                    <h6><i class="ti ti-credit-card"></i> Billing Address</h6>
                    <address class="mb-0">
                      John Doe <br>
                      4135 Parkway Street,<br>
                      Los Angeles, CA 90017,<br>
                      USA
                    </address>
                    <p class="mb-0 mt-3">+123456789</p>
                  </li>
                  <li class="list-group-item flex-fill p-4 text-heading">
                    <h6 class="d-flex gap-1"><i class="ti ti-ship"></i> Shipping Method</h6>
                    <p class="fw-semibold mb-3">Preferred Method:</p>
                    Standard Delivery<br>
                    (Normally 3-4 business days)
                  </li>
                </ul>
              </div>
            </div>

            <div class="row">
              <!-- Confirmation items -->
              <div class="col-xl-9 mb-3 mb-xl-0">
                <ul class="list-group">
                  <li class="list-group-item p-4">
                    <div class="d-flex gap-3">
                      <div class="flex-shrink-0">
                        <img src="../../assets/img/products/1.png" alt="google home" class="w-px-75">
                      </div>
                      <div class="flex-grow-1">
                        <div class="row">
                          <div class="col-md-8">
                            <a href="javascript:void(0)" class="text-body">
                              <p>Google - Google Home - White</p>
                            </a>
                            <div class="text-muted mb-1 d-flex flex-wrap">
                              <span class="me-1">Sold by:</span>
                              <a href="javascript:void(0)" class="me-3">Apple</a>
                              <span class="badge bg-label-success">In Stock</span>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="text-md-end">
                              <div class="my-2 my-lg-4">
                                <span class="text-primary">$299/</span><s class="text-muted">$359</s>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                  <li class="list-group-item p-4">
                    <div class="d-flex gap-3">
                      <div class="flex-shrink-0">
                        <img src="../../assets/img/products/2.png" alt="google home" class="w-px-75">
                      </div>
                      <div class="flex-grow-1">
                        <div class="row">
                          <div class="col-md-8">
                            <a href="javascript:void(0)" class="text-body">
                              <p>Apple iPhone 11 (64GB, Black)</p>
                            </a>
                            <div class="text-muted mb-1 d-flex flex-wrap">
                              <span class="me-1">Sold by:</span>
                              <a href="javascript:void(0)" class="me-3">Apple</a>
                              <span class="badge bg-label-success">In Stock</span>
                            </div>
                          </div>
                          <div class="col-md-4">
                            <div class="text-md-end">
                              <div class="my-2 my-lg-4">
                                <span class="text-primary">$299/</span><s class="text-muted">$359</s>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </li>
                </ul>
              </div>
              <!-- Confirmation total -->
              <div class="col-xl-3">
                <div class="border rounded p-4 pb-3">
                  <!-- Price Details -->
                  <h6>Price Details</h6>
                  <dl class="row mb-0">
                    <dt class="col-6 fw-normal">Order Total</dt>
                    <dd class="col-6 text-end">$1100.00</dd>

                    <dt class="col-sm-6 fw-normal">Delivery Charges</dt>
                    <dd class="col-sm-6 text-end">
                      <s>$5.00</s> <span class="badge bg-label-success ms-1">Free</span>
                    </dd>
                  </dl>
                  <hr class="mx-n4">
                  <dl class="row mb-0">
                    <dt class="col-6">Total</dt>
                    <dd class="col-6 fw-semibold text-end mb-0">$1100.00</dd>
                  </dl>
                </div>
              </div>
            </div>
          </div> --}}
        </form>
      </div>
    </div>
    <!--/ Checkout Wizard -->
  </div>
@endsection
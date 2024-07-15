@extends('layouts.admin')

@section('title')
    Calculation - Add Rental Price
@endsection

@section('section-admin')
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row">
            <div class="col-md-5">
                <div class="card mb-4">
                    <h5 class="card-header">Calculation</h5>
                    <div class="card-body">
                        <form method="post" id="form-warehouse-subscription">
                            @csrf
                            @if (request()->is('*edit*'))
                                @method('PATCH')
                            @endif
                            <div class="mb-3">
                                <label for="warehouse_id" class="form-label">Warehouse</label>
                                <div class="input-group">
                                    <input type="search" class="form-control" id="warehouse_id" name="warehouse_id"
                                        placeholder="Search Warehouse"
                                        value="{{ old('warehouse_id', $warehouse_subscription_cart->warehouse->name ?? '') }}"
                                        data-building-area="{{ $warehouse_subscription_cart->warehouse->building_area ?? '' }}"
                                        data-surface-area="{{ $warehouse_subscription_cart->warehouse->surface_area ?? '' }}"
                                        data-id="{{ $warehouse_subscription_cart->warehouse->id ?? '' }}" readonly required>
                                    <span class="input-group-text cursor-pointer" data-bs-toggle="modal"
                                        data-bs-target="#searchWarehouses" id="button-trigger-modal-show-list-warehouses"><i
                                            class="ti ti-search"></i></span>
                                </div>
                                <div class="form-text">
                                    Select the warehouse where the calculation will be performed.
                                </div>
                            </div>

                            <div class="mb-3">

                                <label for="subscription_id" class="form-label">Subscription</label>
                                <select class="form-select" id="subscription_id" name="subscription_id" required>
                                    @if ($subscriptions->count() == 0)
                                        <option value="" selected>No Subscription</option>
                                    @else
                                        <option value="">Select Subscription</option>
                                    @endif
                                    @foreach ($subscriptions as $subscription)
                                        <option value="{{ $subscription->id }}"
                                            {{ old('subscription_id', $warehouse_subscription_cart->subscription_id ?? '') == $subscription->id ? 'selected' : '' }}
                                            data-month-duration="{{ $subscription->month_duration }}">
                                            {{ $subscription->month_duration . ' Month - ' . $subscription->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <hr>

                            <div>
                                <div class="alert alert-primary alert-dismissible d-flex align-items-baseline"
                                    role="alert">
                                    <span class="alert-icon alert-icon-lg me-2">
                                        <i class="ti ti-exclamation-mark ti-sm"></i>
                                    </span>
                                    <div class="d-flex flex-column ps-1">
                                        <h5 class="alert-heading mb-2">Tips and how to calculate total rental!</h5>
                                        <p class="mb-3">
                                            The price is something that determines whether the buyer is interested in
                                            the
                                            offer
                                            or not.<br>
                                            The correct way to calculate the price rate between the shortest and longest
                                            subscription duration is as follows:<br>
                                        </p>
                                        <p class="mb-3">
                                            Subscription A (1 Month) with a set price_rate of Rp. 20,000.<br>
                                            Subscription B (6 Months) with a set price_rate of Rp. 15,000.<br>
                                            Subscription C (12 Months) with a set price_rate of Rp. 10,000.<br>
                                        </p>
                                        <p class="mb-2">
                                            Formula: ((price_rate x total building area) + ((surface area - building
                                            area) x
                                            price_rate)) x month duration<br><br>

                                            When the calculation is done using the above formula, the total monthly
                                            rental
                                            price
                                            will be found, and it is more economical when renting for the longest
                                            subscription
                                            duration.<br><br>

                                            *The term "price rate" refers to the price per m2.
                                        </p>
                                        </p>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <label for="price_rate" class="form-label">Price Rate</label>
                                            <input type="text" class="form-control" id="price_rate" name="price_rate"
                                                placeholder="Input Price Rate" value="@rupiah(old('price_rate', $warehouse_subscription_cart->price_rate ?? 0))" required>
                                        </div>
                                        <div class="col-6">
                                            <label for="total_price" class="form-label">Total Price Rental/Month</label>
                                            <input type="search" class="form-control" id="total_price" name="total_price"
                                                readonly placeholder="Rp. 0" value="@rupiah(old('total_price', $warehouse_subscription_cart->total_price ?? 0))"
                                                data-total-price="{{ $warehouse_subscription_cart->total_price ?? 0 }}"
                                                required>
                                            <div class="form-text">
                                                Filled automatically.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>



                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-danger"
                                    id="button-cancel-warehouse-subscription">Cancel</button>
                                <button type="button" class="btn btn-primary"
                                    id="{{ request()->is('*edit*') ? 'button-update-warehouse-subscription' : 'button-submit-warehouse-subscription' }}"
                                    data-id="{{ isset($warehouse_subscription) ? $warehouse_subscription->id : '' }}">{{ request()->is('*edit*') ? 'Edit' : 'Submit' }}</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card mb-4">
                    <h5 class="card-header">Data of Warehouse Subscription</h5>
                    <div class="card-body">
                        <div class="card-datatable table-responsive">
                            <table class="table border-top" id="listWarehouseSubscriptionsTable"
                                data-id="{{ $warehouse_subscription_cart->warehouse_id ?? 'null' }}">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th class="text-center">No</th>
                                        <th class="text-center">Warehouse</th>
                                        <th class="text-center">Subscription</th>
                                        <th class="text-center">Month Duration</th>
                                        <th class="text-center">Price Rate</th>
                                        <th class="text-center">Total Price</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>




    </div>
@endsection

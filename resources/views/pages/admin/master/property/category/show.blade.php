@extends('layouts.admin')

@section('title')
    Master - Detail Warehouse Category
@endsection

@section('section-admin')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        @if ($warehouse_category->warehouse->count() == 0)
        <div class="col-md-12">
            <div class="alert alert-danger">
                <h5 class="alert-heading mb-2">Warehouse in this category is empty!</h5>
                <p class="mb-0">
                    Add a new warehouse with the category = {{ $warehouse_category->category }}.
                </p>
            </div>
        </div>
        @else
            @foreach ($warehouse_category->warehouse as $warehouse)
            <div class="col-md-6 col-lg-4">
                <div class="card">
                    <img class="card-img-top" src="{{ $warehouse->getFirstMediaUrl('warehouse_images') }}" alt="Card image cap">
                    <div class="card-body">
                    <h5 class="card-title">{{ $warehouse->name }}</h5>
                    <p class="card-text">{{ $warehouse->description }}.</p>
                    </div>
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item">Category <span style="float: right">{{ $warehouse->warehouse_category->category }}</span></li>
                    <li class="list-group-item">Capacity Volume <span style="float: right">{{ $warehouse->capacity }}m<sup>3</sup></span></li>
                    <li class="list-group-item">Surface Area <span style="float: right">{{ $warehouse->surface_area }}m<sup>2</sup></span></li>
                    <li class="list-group-item">Building Area <span style="float: right">{{ $warehouse->building_area }}m<sup>2</sup></span></li>
                    <li class="list-group-item">City <span style="float: right">{{ $warehouse->city }}</span></li>
                    <li class="list-group-item">Address <span style="float: right">{{ $warehouse->address }}</span></li>
                    <li class="list-group-item">Status 
                        <span style="float: right" class="text-capitalize">
                            @if ($warehouse->status == 'available')
                                <span class="badge bg-success d-flex justify-content-center">{{ $warehouse->status }}</span>
                            @elseif ($warehouse->status == 'rented')
                                <span class="badge bg-warning d-flex justify-content-center">{{ $warehouse->status }}</span>
                            @elseif ($warehouse->status == 'maintenance')
                                <span class="badge bg-info d-flex justify-content-center">{{ $warehouse->status }}</span>
                            @elseif ($warehouse->status == 'damaged')
                                <span class="badge bg-danger d-flex justify-content-center">{{ $warehouse->status }}</span>
                            @elseif ($warehouse->status == 'unavailable')
                                <span class="badge bg-secondary d-flex justify-content-center">{{ $warehouse->status }}</span>
                            @endif
                        </span>
                    </li>
                    <li class="list-group-item"><b>Rental Price</b><br>
                        <div class="demo-inline-spacing mt-3">
                            <ol class="list-group list-group-numbered">
                            @foreach ($warehouse->warehouse_subscription->sortBy('subscription.month_duration') as $subscription)
                                <li class="list-group-item">
                                    {{ $subscription->subscription->name }} | @convertMonthsToYearsAndMonths($subscription->subscription->month_duration)
                                    <span style="float: right;" class="fw-bold">@rupiah($subscription->total_price)</span>
                                </li>
                            @endforeach
                            </ol>
                        </div>
                    </li>
                    </ul>
                    <div class="card-body d-flex justify-content-center">
                    <a href="{{ route('master.warehouse.show', $warehouse->id) }}" class="card-link">Details</a>
                    <a href="javascript:void(0)" class="card-link" data-bs-target="#editWarehouse" data-bs-toggle="modal" id="button-trigger-modal-edit-warehouse" data-id="{{ $warehouse->id }}">Edit</a>
                    <form action="{{ route('master.warehouse.destroy', $warehouse->id) }}" method="post" class="form-delete-warehouse-{{ $warehouse->id }}">
                        @csrf
                        @method('delete')
                        <a href="javascript:void(0)" class="card-link ms-4" data-id="{{ $warehouse->id }}" id="button-delete-warehouse">Delete</a>
                    </form>
                    </div>
                </div>
            </div>
            @endforeach
        @endif
    </div>
</div>
@endsection
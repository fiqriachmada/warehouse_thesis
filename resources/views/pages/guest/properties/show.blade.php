@extends('layouts.guest')

@section('title')
    Warehouse - Detail Properties
@endsection

@section('section-guest')
<div class="container">
    <div class="row">
        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12 mb-5">
                    <div class="single-blog-item">
                        <div class="swiper swiper-initialized swiper-horizontal swiper-pointer-events swiper-backface-hidden swiper-container mt-5" id="swiper-with-progress">
							<div class="swiper-wrapper" id="swiper-wrapper-{{ $warehouse->id }}" aria-live="polite" style="transition-duration: 0ms; transform: translate3d(0px, 0px, 0px);">
							@foreach ($warehouse->getMedia('warehouse_images') as $media)
								<div class="swiper-slide" style="background-image: url({{ $media->getUrl() }}); background-size: cover; height: 500px" role="group"></div>
							@endforeach
							</div>
							<div class="swiper-pagination swiper-pagination-progressbar swiper-pagination-horizontal"><span class="swiper-pagination-progressbar-fill" style="transform: translate3d(0px, 0px, 0px) scaleX(0.4) scaleY(1); transition-duration: 300ms;"></span></div>
							<div class="swiper-button-next swiper-button-white custom-icon" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-{{ $warehouse->id }}" aria-disabled="false"></div>
							<div class="swiper-button-prev swiper-button-white custom-icon" tabindex="0" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-{{ $warehouse->id }}" aria-disabled="false"></div>
							<span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
						</div>

                        @php
                            $warehouse_subscriptions = [];
                        @endphp
                        @foreach ($warehouse->warehouse_subscription as $warehouse_subscription)
                            @php
                                $warehouse_subscriptions = $warehouse_subscription->id;
                            @endphp
                        @endforeach

                        <div class="blog-item-content bg-white p-5">
                            <div class="blog-item-meta bg-gray pt-2 pb-1 px-3 d-flex justify-content-between">
								<span class="text-muted text-capitalize d-inline-block me-3"><i class="ti-package me-2"></i> {{ $warehouse->warehouse_category->category }}</span>
								<span class="text-muted text-capitalize d-inline-block me-3"><i class="ti-bar-chart me-2"></i>{{ \App\Models\DetailTransaction::join('transactions', 'transactions.id', 'detail_transactions.transaction_id')->whereIn('warehouse_subscription_id', [$warehouse_subscriptions])->where('transactions.status', 'confirmed')->count() }} Reserved</span>
								<span class="text-muted text-capitalize d-inline-block me-3"><i class="ti-time me-1"></i> {{ \Carbon\Carbon::parse($warehouse->created_at)->format('d/m/Y') }}</span>
                                <span class="text-muted text-capitalize d-inline-block me-3"><i class="ti-unlink me-1"></i> 
                                    @if ($warehouse->status == 'available')
                                        <div class="badge bg-success">{{ $warehouse->status }}</div>
                                    @elseif ($warehouse->status == 'unavailable' || $warehouse->status == 'rented')
                                        <div class="badge bg-danger">{{ $warehouse->status }}</div>
                                    @elseif ($warehouse->status == 'maintenance' || $warehouse->status == 'damaged')
                                        <div class="badge bg-warning">{{ $warehouse->status }}</div>
                                    @endif
                                </span>
							</div>

                            <h2 class="mt-3 mb-4 text-capitalize">{{ $warehouse->name }}</h2>
                            <p class="lead mb-4">{{ $warehouse->description }}</p>

                            <h3 class="quote">Specification</h3>

                            <span class="lead mb-4 font-weight-normal text-black">
                                <table style="width:100%" class="mb-4">
                                    <tr>
                                        <th class="w-50">Capacity:</th>
                                        <td>{{ $warehouse->capacity }}m<sup>3</sup></td>
                                    </tr>
                                    <tr>
                                        <th>Surface Area:</th>
                                        <td>{{ $warehouse->surface_area }}m<sup>3</sup></td>
                                    </tr>
                                    <tr>
                                        <th>Building Area:</th>
                                        <td>{{ $warehouse->building_area }}m<sup>3</sup></td>
                                    </tr>
                                </table>
                            </span>

                            <h3 class="quote">Including</h3>

                            <span class="lead mb-4 font-weight-normal text-black">
                                <table style="width:100%" class="mb-4">
                                    <tr>
                                        <th class="w-50">Storage Shelves:</th>
                                        <td>{{ $warehouse->storage_shelves }}</td>
                                    </tr>
                                    <tr>
                                        <th>Toilet and Rest Area:</th>
                                        <td>{{ $warehouse->toilet_and_rest_area }}</td>
                                    </tr>
                                    <tr>
                                        <th>Effective Lighting System:</th>
                                        <td class="text-capitalize">{{ $warehouse->effective_lighting_system }}</td>
                                    </tr>
                                    <tr>
                                        <th>Advanced Security System:</th>
                                        <td class="text-capitalize">{{ $warehouse->advanced_security_system }}</td>
                                    </tr>
                                    <tr>
                                        <th>Electricity:</th>
                                        <td class="text-capitalize">{{ $warehouse->electricity }}</td>
                                    </tr>
                                    <tr>
                                        <th>Administrative Room or Office:</th>
                                        <td class="text-capitalize">{{ $warehouse->administrative_room_or_office }}</td>
                                    </tr>
                                    <tr>
                                        <th>Worker Safety Equipment:</th>
                                        <td class="text-capitalize">{{ $warehouse->worker_safety_equipment }}</td>
                                    </tr>
                                    <tr>
                                        <th>Firefighting Tools:</th>
                                        <td class="text-capitalize">{{ $warehouse->worker_safety_equipment }}</td>
                                    </tr>
                                </table>
                            </span>

                            @if (!is_null($warehouse->goods_handling_equipment))

                            <h3 class="quote">Additional Support</h3>

                            <span class="lead mb-4 font-weight-normal text-black">
                                <ol style="padding-left: 1rem">
                                    @foreach (json_decode($warehouse->goods_handling_equipment, true) as $item)
                                        <li>{{ $item['value'] }}</li>
                                    @endforeach
                                </ol>
                            </span>
                            @endif

                            <h3 class="quote">Location</h3>

                            <span class="lead mb-4 font-weight-normal text-black">
                                <table style="width:100%" class="mb-4">
                                    <tr>
                                        <th class="w-50">Location:</th>
                                        <td>{{ $warehouse->country->name }}</td>
                                    </tr>
                                    <tr>
                                        <th style="width: 40%">City:</th>
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
                            </span>
							<a href="{{ route('login.user') }}" class="btn btn-small-primary btn-primary btn-round-full mt-5" style="float: right">Reserve Now</a>
                        </div>
                    </div>
                </div>


                {{-- <div class="col-lg-12 mb-5">
                    <div class="posts-nav bg-white p-5 d-lg-flex d-md-flex justify-content-between ">
                        <a class="post-prev align-items-center" href="#">
                            <div class="posts-prev-item mb-4 mb-lg-0">
                                <span class="nav-posts-desc text-color">- Previous Post</span>
                                <h6 class="nav-posts-title mt-1">
                                    Donec consectetuer ligula <br>vulputate sem tristique.
                                </h6>
                            </div>
                        </a>
                        <div class="border"></div>
                        <a class="posts-next" href="#">
                            <div class="posts-next-item pt-4 pt-lg-0">
                                <span class="nav-posts-desc text-lg-right text-md-right text-color d-block">- Next Post</span>
                                <h6 class="nav-posts-title mt-1">
                                    Ut aliquam sollicitudin leo.
                                </h6>
                            </div>
                        </a>
                    </div>
                </div>

                <div class="col-lg-12 mb-5">
                    <div class="comment-area card border-0 p-5">
                        <h4 class="mb-4">2 Comments</h4>
                        <ul class="comment-tree list-unstyled">
                            <li class="mb-5">
                                <div class="comment-area-box">
                                    <img loading="lazy" alt="comment-author" src="images/blog/test1.jpg" class="img-fluid float-left mr-3 mt-2">

                                    <h5 class="mb-1">Philip W</h5>
                                    <span>United Kingdom</span>

                                    <div class="comment-meta mt-4 mt-lg-0 mt-md-0 float-lg-right float-md-right">
                                        <a href="#"><i class="icofont-reply mr-2 text-muted"></i>Reply |</a>
                                        <span class="date-comm">Posted October 7, 2018 </span>
                                    </div>

                                    <div class="comment-content mt-3">
                                        <p>Some consultants are employed indirectly by the client via a consultancy staffing company, a
                                            company that provides consultants on an agency basis. </p>
                                    </div>
                                </div>
                            </li>

                            <li>
                                <div class="comment-area-box">
                                    <img loading="lazy" alt="comment-author" src="images/blog/test2.jpg" class="mt-2 img-fluid float-left mr-3">

                                    <h5 class="mb-1">Philip W</h5>
                                    <span>United Kingdom</span>

                                    <div class="comment-meta mt-4 mt-lg-0 mt-md-0 float-lg-right float-md-right">
                                        <a href="#"><i class="icofont-reply mr-2 text-muted"></i>Reply |</a>
                                        <span class="date-comm">Posted October 7, 2018</span>
                                    </div>

                                    <div class="comment-content mt-3">
                                        <p>Some consultants are employed indirectly by the client via a consultancy staffing company, a
                                            company that provides consultants on an agency basis. </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="col-lg-12">
                    <form class="contact-form bg-white rounded p-5" id="comment-form">
                        <h4 class="mb-4">Write a comment</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="name" id="name" placeholder="Name:">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="form-control" type="text" name="mail" id="mail" placeholder="Email:">
                                </div>
                            </div>
                        </div>


                        <textarea class="form-control mb-3" name="comment" id="comment" cols="30" rows="5" placeholder="Comment"></textarea>

                        <input class="btn btn-main btn-round-full" type="submit" name="submit-contact" id="submit_contact" value="Submit Message">
                    </form>
                </div> --}}
            </div>
        </div>

        <div class="col-lg-4 mt-lg-0">
            <div class="sidebar-wrap">
                <div class="sidebar-widget latest-post card border-0 p-4 mb-3 mt-4">
                    <h5>Other Properties</h5>

                    @foreach ($warehouses as $warehouse)
                    <div class="row align-items-center border-bottom py-3">
                        <div class="col-md-3">
                            <img loading="lazy" class="img-fluid" src="{{ $warehouse->getFirstMediaUrl('warehouse_images') }}" alt="{{ $warehouse->name }}">
                        </div>
                        <div class="col-md-9">
                            <h6 class="my-2 text-capitalize"><a href="{{ route('our.properties.show', $warehouse->id) }}" >{{ $warehouse->name }}</a></h6>
                            <span class="text-sm text-muted">{{ \Carbon\Carbon::parse($warehouse->created_at)->format('d F Y') }}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
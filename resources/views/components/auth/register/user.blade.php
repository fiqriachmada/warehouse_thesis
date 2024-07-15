@extends('layouts.tenant')

@section('authentication')

<style>
    .bs-stepper-header {
        display: flex;
    }
</style>

<div
    class="d-none d-lg-flex col-lg-4 align-items-center justify-content-center p-5 auth-cover-bg-color position-relative auth-multisteps-bg-height">
    <img
    src="{{ asset('assets/img/illustrations/auth-register-multisteps-illustration.png') }}"
    alt="auth-register-multisteps"
    class="img-fluid"
    width="280" />

    <img
    src="{{ asset('assets/img/illustrations/bg-shape-image-light.png') }}"
    alt="auth-register-multisteps"
    class="platform-bg"
    data-app-light-img="illustrations/bg-shape-image-light.png"
    data-app-dark-img="illustrations/bg-shape-image-dark.png" />
</div>

<div class="d-flex col-lg-8 align-items-center justify-content-center p-sm-5 p-3">
    <div class="w-px-700">
        <div id="multiStepsValidation" class="bs-stepper shadow-none">
            <div class="bs-stepper-header border-bottom-0">
                <div class="step" data-target="#accountDetailsValidation">
                    <button type="button" class="step-trigger">
                    <span class="bs-stepper-circle"><i class="ti ti-smart-home ti-sm"></i></span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Account</span>
                        <span class="bs-stepper-subtitle">Account Details</span>
                    </span>
                    </button>
                </div>
                <div class="line">
                    <i class="ti ti-chevron-right"></i>
                </div>
                <div class="step" data-target="#personalInfoValidation">
                    <button type="button" class="step-trigger">
                    <span class="bs-stepper-circle"><i class="ti ti-users ti-sm"></i></span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Personal</span>
                        <span class="bs-stepper-subtitle">Enter Information</span>
                    </span>
                    </button>
                </div>
                {{-- <div class="line">
                    <i class="ti ti-chevron-right"></i>
                </div> --}}
                {{-- <div class="step" data-target="#billingLinksValidation">
                    <button type="button" class="step-trigger">
                    <span class="bs-stepper-circle"><i class="ti ti-file-text ti-sm"></i></span>
                    <span class="bs-stepper-label">
                        <span class="bs-stepper-title">Billing</span>
                        <span class="bs-stepper-subtitle">Payment Details</span>
                    </span>
                    </button>
                </div> --}}
            </div>

            <div class="bs-stepper-content">
                <form id="multiStepsForm" onSubmit="return false" class="form-submit-register-tenant" method="POST">
                    @csrf
                    <!-- Account Details -->
                    <div id="accountDetailsValidation" class="content">
                    <div class="content-header mb-4">
                        <h3 class="mb-1">Account Information</h3>
                        <p>Enter Your Account Details</p>
                    </div>
                    <div class="row g-3">
                        <div class="col-sm-6">
                            <label class="form-label" for="username">Username</label>
                            <input
                                type="text"
                                name="username"
                                id="username"
                                class="form-control @error('username') is-invalid @enderror"
                                value="{{ old('username') }}" />
                            @error('username')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label class="form-label" for="email">Email</label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="form-control @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" />
                            @error('email')
                                <div class="invalid-feedback"> {{ $message }} </div>
                            @enderror
                        </div>
                        <div class="col-sm-6 form-password-toggle">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group input-group-merge">
                                <input
                                type="password"
                                id="password"
                                name="password"
                                class="form-control"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password" />
                                <span class="input-group-text cursor-pointer" id="password"
                                ><i class="ti ti-eye-off"></i
                                ></span>
                            </div>
                        </div>
                        <div class="col-sm-6 form-password-toggle">
                            <label class="form-label" for="confirm_password">Confirm Password</label>
                            <div class="input-group input-group-merge">
                                <input
                                type="password"
                                id="confirm_password"
                                name="confirm_password"
                                class="form-control"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="confirm_password" />
                                <span class="input-group-text cursor-pointer" id="confirm_password"
                                ><i class="ti ti-eye-off"></i
                                ></span>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-between mt-4">
                            <button class="btn btn-label-secondary btn-prev" disabled>
                                <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                                <span class="align-middle d-sm-inline-block d-none">Previous</span>
                            </button>
                            <button class="btn btn-primary btn-next">
                                <span class="align-middle d-sm-inline-block d-none me-sm-1 me-0">Next</span>
                                <i class="ti ti-arrow-right ti-xs"></i>
                            </button>
                        </div>
                    </div>
                    </div>
                    <!-- Personal Info -->
                    <div id="personalInfoValidation" class="content">
                        <div class="content-header mb-4">
                            <h3 class="mb-1">Personal Information</h3>
                            <p>Enter Your Personal Information</p>
                        </div>
                        <div class="row g-3">
                            <div class="col-sm-6">
                                <label class="form-label" for="first_name">First Name</label>
                                <input
                                    type="text"
                                    id="first_name"
                                    name="first_name"
                                    class="form-control @error('first_name') is-invalid @enderror"
                                    value="{{ old('first_name') }}" />
                                @error('first_name')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="last_name">Last Name</label>
                                <input
                                    type="text"
                                    id="last_name"
                                    name="last_name"
                                    class="form-control @error('last_name') is-invalid @enderror"
                                    value="{{ old('last_name') }}" />
                                @error('last_name')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="phone">Phone</label>
                                <input
                                    type="text"
                                    id="phone"
                                    name="phone"
                                    class="form-control multi-steps-mobile @error('phone') is-invalid @enderror"
                                    value="{{ old('phone') }}" />
                                @error('phone')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label" for="npwp">NPWP</label>
                                <input
                                    type="text"
                                    id="npwp"
                                    name="npwp"
                                    class="form-control multi-steps-pincode @error('npwp') is-invalid @enderror"
                                    value="{{ old('npwp') }}" />
                                @error('npwp')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <label class="form-label" for="address">Address</label>
                                <textarea name="address" id="address" cols="10" rows="5" class="form-control @error('address') is-invalid @enderror">{{ old('address') }}</textarea>
                                @error('address')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                            {{-- <div class="col-sm-4">
                                <label class="form-label" for="pob">Place of Birth</label>
                                <input type="text" id="pob" name="pob" class="form-control @error('pob') is-invalid @enderror" value="{{ old('pob') }}" />
                                @error('pob')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label" for="dob">Date of Birth</label>
                                <input type="date" id="dob" name="dob" class="form-control @error('dob') is-invalid @enderror" value="{{ old('dob') }}" />
                                @error('dob')
                                    <div class="invalid-feedback"> {{ $message }} </div>
                                @enderror
                            </div> --}}
                            {{-- <div class="col-sm-4">
                                <label class="form-label d-block">Gender</label>
                                <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="gender" id="male" value="male" {{ old('gender') == 'male' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="male">Male</label>
                                </div>
                                <div class="form-check form-check-inline mt-2">
                                    <input class="form-check-input" type="radio" name="gender" id="female" value="female" {{ old('gender') == 'female' ? 'checked' : '' }}>
                                    <label class="form-check-label" for="female">Female</label>
                                </div>
                            </div> --}}
                            <div class="col-12 d-flex justify-content-between mt-4">
                                <button class="btn btn-label-secondary btn-prev">
                                    <i class="ti ti-arrow-left ti-xs me-sm-1 me-0"></i>
                                    <span class="align-middle d-sm-inline-block d-none">Previous</span>
                                </button>
                                <button type="button" class="btn btn-success btn-next btn-submit" id="button-submit-register-tenant">Submit</button>
                            </div>
                        </div>
                    </div>

                    <!-- Billing Links -->
                    <div id="billingLinksValidation" class="content">
                        <div class="content-header">
                            <h3 class="mb-1">Select Plan</h3>
                            <p>Select plan as per your requirement</p>
                        </div>
                        <!-- Custom plan options -->
                        <div class="row gap-md-0 gap-3 my-4">
                            <div class="col-md">
                            <div class="form-check custom-option custom-option-icon">
                                <label class="form-check-label custom-option-content" for="basicOption">
                                <span class="custom-option-body">
                                    <span class="custom-option-title fs-4 mb-1">Basic</span>
                                    <small class="fs-6">A simple start for start ups & Students</small>
                                    <span class="d-flex justify-content-center">
                                    <sup class="text-primary fs-6 lh-1 mt-3">$</sup>
                                    <span class="fw-semibold fs-2 text-primary">0</span>
                                    <sub class="lh-1 fs-6 mt-auto mb-2 text-muted">/month</sub>
                                    </span>
                                </span>
                                <input
                                    name="customRadioIcon"
                                    class="form-check-input"
                                    type="radio"
                                    value=""
                                    id="basicOption" />
                                </label>
                            </div>
                            </div>
                            <div class="col-md">
                            <div class="form-check custom-option custom-option-icon">
                                <label class="form-check-label custom-option-content" for="standardOption">
                                <span class="custom-option-body">
                                    <span class="custom-option-title fs-4 mb-1">Standard</span>
                                    <small class="fs-6">For small to medium businesses</small>
                                    <span class="d-flex justify-content-center">
                                    <sup class="text-primary fs-6 lh-1 mt-3">$</sup>
                                    <span class="fw-semibold fs-2 text-primary">99</span>
                                    <sub class="lh-1 fs-6 mt-auto mb-2 text-muted">/month</sub>
                                    </span>
                                </span>
                                <input
                                    name="customRadioIcon"
                                    class="form-check-input"
                                    type="radio"
                                    value=""
                                    id="standardOption"
                                    checked />
                                </label>
                            </div>
                            </div>
                            <div class="col-md">
                            <div class="form-check custom-option custom-option-icon">
                                <label class="form-check-label custom-option-content" for="enterpriseOption">
                                <span class="custom-option-body">
                                    <span class="custom-option-title fs-4 mb-1">Enterprise</span>
                                    <small class="fs-6">Solution for enterprise & organizations</small>
                                    <span class="d-flex justify-content-center">
                                    <sup class="text-primary fs-6 lh-1 mt-3">$</sup>
                                    <span class="fw-semibold fs-2 text-primary">499</span>
                                    <sub class="lh-1 fs-6 mt-auto mb-2 text-muted">/year</sub>
                                    </span>
                                </span>
                                <input
                                    name="customRadioIcon"
                                    class="form-check-input"
                                    type="radio"
                                    value=""
                                    id="enterpriseOption" />
                                </label>
                            </div>
                            </div>
                        </div>
                        <!--/ Custom plan options -->
                        <div class="content-header mb-4">
                            <h3 class="mb-1">Payment Information</h3>
                            <p>Enter your card information</p>
                        </div>
                        <!-- Credit Card Details -->
                        <div class="row g-3">
                            <div class="col-md-12">
                            <label class="form-label w-100" for="multiStepsCard">Card Number</label>
                            <div class="input-group input-group-merge">
                                <input
                                id="multiStepsCard"
                                class="form-control multi-steps-card"
                                name="multiStepsCard"
                                type="text"
                                placeholder="1356 3215 6548 7898"
                                aria-describedby="multiStepsCardImg" />
                                <span class="input-group-text cursor-pointer" id="multiStepsCardImg"
                                ><span class="card-type"></span
                                ></span>
                            </div>
                            </div>
                            <div class="col-md-5">
                            <label class="form-label" for="multiStepsName">Name On Card</label>
                            <input
                                type="text"
                                id="multiStepsName"
                                class="form-control"
                                name="multiStepsName"
                                placeholder="John Doe" />
                            </div>
                            <div class="col-6 col-md-4">
                            <label class="form-label" for="multiStepsExDate">Expiry Date</label>
                            <input
                                type="text"
                                id="multiStepsExDate"
                                class="form-control multi-steps-exp-date"
                                name="multiStepsExDate"
                                placeholder="MM/YY" />
                            </div>
                            <div class="col-6 col-md-3">
                            <label class="form-label" for="multiStepsCvv">CVV Code</label>
                            <div class="input-group input-group-merge">
                                <input
                                type="text"
                                id="multiStepsCvv"
                                class="form-control multi-steps-cvv"
                                name="multiStepsCvv"
                                maxlength="3"
                                placeholder="654" />
                                <span class="input-group-text cursor-pointer" id="multiStepsCvvHelp"
                                ><i
                                    class="ti ti-help text-muted"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Card Verification Value"></i
                                ></span>
                            </div>
                            </div>
                            
                        </div>
                        <!--/ Credit Card Details -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\TenantProfileController;
use App\Http\Controllers\TenantReportingController;

Route::group(['middleware' => ['cekUserLogin:tenant']], function(){
    
    Route::controller(PricingController::class)->group(function () {
        Route::get('pricing/{warehouse_category}', 'pricing_index')->name('pricing.index');
        Route::post('pricing/{warehouse}/cart', 'pricing_store_cart')->name('pricing.store.cart');
        Route::get('pricing/{warehouse}/warehouse-detail', 'pricing_show')->name('pricing.show');
    });

    Route::controller(CartController::class)->group(function () {
        Route::get('shopping-cart', 'cart_index')->name('shopping.cart.index');
        Route::post('shopping-cart', 'cart_store')->name('shopping.cart.store');
        Route::get('shopping-cart/payment/{transaction}', 'cart_payment')->name('shopping.cart.payment');
    });

    Route::controller(CheckoutController::class)->group(function () {
        Route::get('transaction/{status}', 'transaction_index')->name('tenant.transaction.index');
        Route::get('transaction/{transaction}/detail', 'transaction_show')->name('tenant.transaction.show');
        Route::post('transaction/{transaction}', 'transaction_store')->name('tenant.transaction.store');
    });

    Route::controller(WarehouseController::class)->group(function () {
        Route::get('warehouse/{warehouse}', 'warehouse_index')->name('warehouse.index');
    });

    Route::controller(TenantProfileController::class)->group(function () {
        Route::get('tenant/profile', 'tenant_profile_index')->name('tenant.profile');

        Route::get('settings/tenant-profile', 'tenant_setting_profile_index')->name('tenant.settings.profile');
        Route::patch('settings/tenant-profile/{tenant}', 'tenant_setting_profile_update')->name('tenant.settings.profile.update');
        Route::get('settings/tenant-password', 'tenant_setting_password_index')->name('tenant.settings.password');
        Route::patch('settings/tenant-password/{tenant}', 'tenant_setting_password_update')->name('tenant.settings.password.update');
    });

    Route::controller(TenantReportingController::class)->group(function () {
        Route::get('reporting/{warehouse}/sales/{period}', 'reporting_periodic_sales')->name('reporting.periodic.sales.index');
        Route::get('reporting/{warehouse}/performance/{type}', 'reporting_performance')->name('reporting.performance.index');
        Route::get('history/{warehouse}/{type}', 'reporting_history')->name('reporting.history.index');

        Route::get('reporting/{warehouse}/sales-print-daily/{date}', 'reporting_daily_sales_print')->name('reporting.periodic.daily.sales.print');
        Route::get('reporting/{warehouse}/sales-print-monthly/{date}', 'reporting_monthly_sales_print')->name('reporting.periodic.monthly.sales.print');
        Route::get('reporting/{warehouse}/sales-print-yearly/{date}', 'reporting_yearly_sales_print')->name('reporting.periodic.yearly.sales.print');
    });
});
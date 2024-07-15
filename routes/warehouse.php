<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\InboundController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OutboundController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RackController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\warehouseReportingController;

Route::group(['middleware' => ['cekUserLogin:tenant']], function(){

    Route::controller(WarehouseController::class)->group(function () {
        Route::get('warehouse/{warehouse}/dashboard', 'warehouse_index')->name('warehouse.index');
    });
    
    Route::controller(ProductController::class)->group(function () {
        Route::get('warehouse/{warehouse}/products', 'warehouse_product_index')->name('warehouse.products.index');
        Route::get('warehouse/{warehouse}/products/add', 'warehouse_product_create');
        Route::post('warehouse/{warehouse}/products', 'warehouse_product_store')->name('warehouse.products.store');
        Route::get('warehouse/{warehouse}/products/{product}', 'warehouse_product_edit')->name('warehouse.products.edit');
        Route::patch('warehouse/{warehouse}/products/{product}', 'warehouse_product_update')->name('warehouse.products.update');
        Route::get('warehouse/{warehouse}/products/{product}/show', 'warehouse_product_show')->name('warehouse.products.show');
        Route::delete('warehouse/{warehouse}/products/{product}', 'warehouse_product_delete')->name('warehouse.products.destroy');
    });

    Route::controller(ProductCategoryController::class)->group(function () {
        Route::get('warehouse/{warehouse}/categories', 'warehouse_category_index')->name('warehouse.product.categories.index');
        Route::post('warehouse/{warehouse}/categories', 'warehouse_category_store')->name('warehouse.product.categories.store');
        Route::patch('warehouse/categories/{category}', 'warehouse_category_update')->name('warehouse.product.categories.update');
        Route::get('warehouse/{warehouse}/categories/{category}', 'warehouse_category_show')->name('warehouse.product.categories.show');
        Route::delete('warehouse/{warehouse}/categories/{category}', 'warehouse_category_delete')->name('warehouse.product.categories.destroy');
    });
    
    Route::controller(RackController::class)->group(function () {
        Route::get('warehouse/{warehouse}/racks', 'warehouse_rack_index')->name('warehouse.racks.index');
        Route::post('warehouse/{warehouse}/racks', 'warehouse_rack_store')->name('warehouse.racks.store');
        Route::patch('warehouse/racks/{rack}', 'warehouse_rack_update')->name('warehouse.rack.update');
        Route::get('warehouse/{warehouse}/racks/{rack}', 'warehouse_rack_show')->name('warehouse.rack.show');
        Route::delete('warehouse/{warehouse}/racks/{rack}', 'warehouse_rack_delete')->name('warehouse.rack.destroy');
    });

    Route::controller(SupplierController::class)->group(function () {
        Route::get('warehouse/{warehouse}/suppliers', 'warehouse_supplier_index')->name('warehouse.suppliers.index');
        Route::post('warehouse/{warehouse}/suppliers', 'warehouse_supplier_store')->name('warehouse.suppliers.store');
        Route::patch('warehouse/suppliers/{supplier}', 'warehouse_supplier_update')->name('warehouse.suppliers.update');
        Route::get('warehouse/{warehouse}/suppliers/{supplier}/show', 'warehouse_supplier_show')->name('warehouse.suppliers.show');
        Route::delete('warehouse/{warehouse}/suppliers/{supplier}', 'warehouse_supplier_delete')->name('warehouse.suppliers.destroy');
    });

    Route::controller(CustomerController::class)->group(function () {
        Route::get('warehouse/{warehouse}/customers', 'warehouse_customer_index')->name('warehouse.customers.index');
        Route::post('warehouse/{warehouse}/customers', 'warehouse_customer_store')->name('warehouse.customers.store');
    });

    Route::controller(InboundController::class)->group(function () {
        Route::get('warehouse/{warehouse}/inbounds', 'warehouse_inbound_index')->name('warehouse.inbound.index');
        Route::get('warehouse/{warehouse}/inbounds/add', 'warehouse_inbound_create');
        Route::post('warehouse/{warehouse}/inbounds', 'warehouse_inbound_store')->name('warehouse.inbound.store');
        Route::patch('warehouse/inbounds/{inbound}', 'warehouse_inbound_update')->name('warehouse.inbound.update');
        Route::delete('warehouse/inbounds/{inbound}', 'warehouse_inbound_delete')->name('warehouse.inbound.destroy');
    });

    Route::controller(InventoryController::class)->group(function () {
        Route::get('warehouse/{warehouse}/inventory', 'warehouse_inventory_index')->name('warehouse.inventory.index');
    });

    Route::controller(OutboundController::class)->group(function () {
        Route::get('warehouse/{warehouse}/outbounds', 'warehouse_outbound_index')->name('warehouse.outbound.index');
        Route::post('warehouse/{warehouse}/outbounds/store', 'warehouse_outbound_store')->name('warehouse.outbound.store');
        Route::get('warehouse/{warehouse}/outbounds/add', 'warehouse_outbound_create')->name('warehouse.outbound.create');
        Route::post('warehouse/{warehouse}/outbounds/{customer}/store', 'warehouse_outbound_customer_store')->name('warehouse.outbound.customer.store');
        Route::get('warehouse/{warehouse}/outbound/{outbound}', 'warehouse_outbound_invoice')->name('warehouse.outbound.invoice');
        Route::get('warehouse/{warehouse}/outbound-print/{outbound}', 'warehouse_outbound_invoice_print')->name('warehouse.outbound.invoice.print');
    });

    Route::controller(warehouseReportingController::class)->group(function () {
        Route::get('warehouse/{warehouse}/reporting-sales/{period}', 'warehouse_reporting_sales')->name('reporting.periodic.warehouse.sales.index');
        Route::get('warehouse/{warehouse}/sales-print-daily/{date}', 'warehouse_reporting_daily_sales_print')->name('reporting.periodic.warehouse.daily.sales.print');
        Route::get('warehouse/{warehouse}/sales-print-monthly/{date}', 'warehouse_reporting_monthly_sales_print')->name('reporting.periodic.warehouse.monthly.sales.print');
        Route::get('warehouse/{warehouse}/sales-print-yearly/{date}', 'warehouse_reporting_yearly_sales_print')->name('reporting.periodic.warehouse.yearly.sales.print');

        Route::get('warehouse/{warehouse}/performance/{type}', 'warehouse_reporting_performance')->name('warehouse.performance.index');
    });
});
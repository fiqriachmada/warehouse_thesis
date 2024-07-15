<?php

use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::controller(GuestController::class)->group(function () {
        Route::get('about-us', 'about')->name('about');
        Route::get('service', 'service')->name('service');
        Route::get('our-properties', 'properties')->name('our.properties');
        Route::get('our-properties/{warehouse}', 'properties_detail')->name('our.properties.show');
        Route::get('contact-us', 'contact')->name('contact');
        Route::post('contact-us', 'contact_send')->name('contact.store');
    });
});
<?php

use App\Http\Controllers\Frontend\TestController;
use Illuminate\Support\Facades\Route;

Route::get('order', function () {
    return view('frontend.order.order');
});

Route::post('uploadReceipt', [TestController::class, 'uploadReceipt'])->name('uploadReceipt');

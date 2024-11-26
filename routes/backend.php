<?php

use App\Http\Controllers\System\ActivityLog\ActivityLogController;
use App\Http\Controllers\System\Auth\AuthController;
use App\Http\Controllers\System\Category\CategoryController;
use App\Http\Controllers\System\Category\SubCategoryController;
use App\Http\Controllers\System\Config\ConfigController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\System\Dashboard\DashboardController;
use App\Http\Controllers\System\EmailTemplate\EmailTemplateController;
use App\Http\Controllers\System\File\FileController;
use App\Http\Controllers\System\Inventory\InventoryController;
use App\Http\Controllers\System\LoginLog\LoginLogController;
use App\Http\Controllers\System\Module\ModuleController;
use App\Http\Controllers\System\Permission\PermissionController;
use App\Http\Controllers\System\Product\ProductController;
use App\Http\Controllers\System\Profile\ProfileController;
use App\Http\Controllers\System\Role\RoleController;
use App\Http\Controllers\System\Testimonial\TestimonialController;
use App\Http\Controllers\System\User\UserController;

Route::group(['namespace' => 'System', 'prefix' => 'system'], function () {

    Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::get('/set-password', [AuthController::class, 'setPasswordForm'])->name('login.setPasswordForm');
    Route::post('/set-password', [AuthController::class, 'setPassword'])->name('login.setPassword');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    //Forgot Password
    Route::get('/forgot-password', [AuthController::class, 'forgotPasswordForm'])->name('forgotPasswordForm');
    Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('forgotPassword');

    //Reset Password
    Route::get('/reset-password/{token}', [AuthController::class, 'resetPasswordForm']);
    Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('resetPassword');


    Route::group(['middleware' => ['systemAuth', 'CheckRoleAndPermission']], function () {
        Route::get('/home', [DashboardController::class, 'index'])->name('home.index');

        Route::get('/profile', [ProfileController::class, 'viewProfile'])->name('profile');
        Route::get('/profile/update-profile-form', [ProfileController::class, 'updateProfileForm'])->name('update-profile-form');
        Route::post('/profile/update-profile', [ProfileController::class, 'updateProfile'])->name('update-profile');
        Route::get('/profile/change-password', [ProfileController::class, 'updatePasswordForm'])->name('update-password-form');
        Route::post('/profile/update-password', [ProfileController::class, 'updatePassword'])->name('update-password');


        // Category
        Route::resource('/categories', CategoryController::class);
        Route::get('/categories/change-status/{id}', [CategoryController::class, 'changeStatus']);

        //Sub Category
        Route::resource('/categories/{category}/sub-categories', SubCategoryController::class);
        Route::get('/categories/{category}/sub-categories/change-status/{sub_category}', [CategoryController::class, 'changeStatus']);



        //Config
        Route::resource('/configs', ConfigController::class);

        //User
        Route::resource('/users', UserController::class);
        Route::post('/change-password', [UserController::class, 'changePassword'])->name('changePassword');
        Route::get('/resend-password/{id}', [UserController::class, 'resendPassword'])->name('resendPassword');


        // Role
        Route::resource('/roles', RoleController::class);
        Route::post('/roles/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions');

        //Permission
        Route::resource('/permissions', PermissionController::class);

        //Module
        Route::resource('/modules', ModuleController::class);

        //Activity Log
        Route::resource('/activity-logs', ActivityLogController::class);

        //Login Logs
        Route::resource('/login-logs', LoginLogController::class);

        //Email Template
        Route::resource('/email-templates', EmailTemplateController::class);
        Route::get('/email-templates/change-status/{id}', [EmailTemplateController::class, 'changeStatus']);

        //Email Template
        Route::resource('/products', ProductController::class);
        Route::get('/products/change-status/{id}', [ProductController::class, 'changeStatus']);

        //File
        Route::resource('/files', FileController::class);

        //Testimonials
        Route::resource('/testimonials', TestimonialController::class);
        Route::get('/testimonials/change-status/{id}', [TestimonialController::class, 'changeStatus']);


        //File
        Route::resource('/inventories', InventoryController::class);
    });


    Route::get('/get-sub-category', [SubCategoryController::class, 'getSubCategory'])->name('getSubCategory');
});

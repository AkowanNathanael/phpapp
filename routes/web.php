<?php

use App\Http\Controllers\Authentication;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ServiceController;
use Illuminate\Support\Facades\Route;






// 
Route::get("/login", function () {
    return view("login");
})->name("login");
Route::get("/register", function () {
    return view("register");
})->name("register");
Route::get("/admin/dashboard",function(){
  return view("admin.index");
});

Route::post("/login/auth", [Authentication::class, "login"]);
Route::post("/register/auth", [Authentication::class, "register"]);
Route::get("/admin/category/create", [CategoryController::class, "create"]);
Route::post("/admin/category/store", [CategoryController::class, "store"]);
Route::get("/admin/category", [CategoryController::class, "index"]);
Route::get("/admin/category/{category}", [CategoryController::class, "show"]);
Route::put("/admin/category/{category}", [CategoryController::class, "update"]);
Route::delete("/admin/category/{category}", [CategoryController::class, "destroy"]);
Route::get("/admin/category/{category}/edit", [CategoryController::class, "edit"]);
// 
Route::get("/admin/post/create", [PostController::class, "create"]);
Route::post("/admin/post/store", [PostController::class, "store"]);
Route::get("/admin/post", [PostController::class, "index"]);
Route::get("/admin/post/{post}", [PostController::class, "show"]);
Route::put("/admin/post/{post}", [PostController::class, "update"]);
Route::delete("/admin/post/{post}", [PostController::class, "destroy"]);
Route::get("/admin/post/{post}/edit", [PostController::class, "edit"]);
// 
Route::get("/admin/event/create", [EventController::class, "create"]);
Route::post("/admin/event/store", [EventController::class, "store"]);
Route::get("/admin/event", [EventController::class, "index"]);
Route::get("/admin/event/{event}", [EventController::class, "show"]);
Route::put("/admin/event/{event}", [EventController::class, "update"]);
Route::delete("/admin/event/{event}", [EventController::class, "destroy"]);
Route::get("/admin/event/{event}/edit", [EventController::class, "edit"]);
// 
Route::get("/admin/resource/create", [ResourceController::class, "create"]);
Route::post("/admin/resource/store", [ResourceController::class, "store"]);
Route::get("/admin/resource", [ResourceController::class, "index"]);
Route::get("/admin/resource/{resource}", [ResourceController::class, "show"]);
Route::put("/admin/resource/{resource}", [ResourceController::class, "update"]);
Route::delete("/admin/resource/{resource}", [ResourceController::class, "destroy"]);
Route::get("/admin/resource/{resource}/edit", [ResourceController::class, "edit"]);
// 
Route::get("/admin/service/create", [ServiceController::class, "create"]);
Route::post("/admin/service/store", [ServiceController::class, "store"]);
Route::get("/admin/service", [ServiceController::class, "index"]);
Route::get("/admin/service/{service}", [ServiceController::class, "show"]);
Route::put("/admin/service/{service}", [ServiceController::class, "update"]);
Route::delete("/admin/service/{service}", [ServiceController::class, "destroy"]);
Route::get("/admin/service/{service}/edit", [ServiceController::class, "edit"]);
// 
Route::get("/admin/podcast/create", [PodcastController::class, "create"]);
Route::post("/admin/podcast/store", [PodcastController::class, "store"]);
Route::get("/admin/podcast", [PodcastController::class, "index"]);
Route::get("/admin/podcast/{podcast}", [PodcastController::class, "show"]);
Route::put("/admin/podcast/{podcast}", [PodcastController::class, "update"]);
Route::delete("/admin/podcast/{podcast}", [PodcastController::class, "destroy"]);
Route::get("/admin/podcast/{podcast}/edit", [PodcastController::class, "edit"]);





// 
Route::get('/', function () {
    return view("welcome");
});

Route::get('/blank', function () {
    return view("sneat.html.blank");
});
Route::get('/auth-index', function () {
    return view("sneat.html.index");
});
Route::get('/auth-forgot', function () {
    return view("sneat.html.auth-forgot-password-basic");
});

Route::get('/auth-login', function () {
    return view("sneat.html.auth-login-basic");
});
Route::get('/auth-register', function () {
    return view("sneat.html.auth-register-basic");
});
Route::get('/auth-extended-ui-scrollbar', function () {
    return view("sneat.html.extended-ui-perfect-scrollbar");
});
Route::get('/auth-extended-text-divider', function () {
    return view("sneat.html.extended-ui-text-divider");
});
Route::get('/auth-form-layout-horinzontal', function () {
    return view("sneat.html.form-layouts-horizontal");
});
Route::get('/auth-form-layouts-vertical', function () {
    return view("sneat.html.form-layouts-vertical");
});
Route::get('/auth-form-basic-inputs', function () {
    return view("sneat.html.forms-basic-inputs");
});
Route::get('/auth-form-input-groups', function () {
    return view("sneat.html.forms-input-groups");
});
Route::get('/auth-icons-boxicons', function () {
    return view("sneat.html.icons-boxicons");
});
Route::get('/auth-layouts', function () {
    return view("sneat.html.layouts-blank");
});
Route::get('/auth-layouts-container', function () {
    return view("sneat.html.layouts-container");
});
Route::get('/auth-layouts-fluid', function () {
    return view("sneat.html.layouts-fluid");
});
Route::get('/auth-layouts-without-menu', function () {
    return view("sneat.html.layouts-without-menu");
});
Route::get('/auth-layouts-without-navbar', function () {
    return view("sneat.html.layouts-without-navbar");
});
Route::get('/auth-pages-account', function () {
    return view("sneat.html.pages-account-settings-account");
});
Route::get('/auth-pages-connection', function () {
    return view("sneat.html.pages-account-settings-connections");
});
Route::get('/auth-pages-notifications', function () {
    return view("sneat.html.pages-account-settings-notifications");
});
Route::get('/auth-error', function () {
    return view("sneat.html.pages-misc-error");
});
Route::get('/auth-maintenance', function () {
    return view("sneat.html.pages-misc-under-maintenance");
});
Route::get('/auth-cards', function () {
    return view("sneat.html.cards-basic");
});
Route::get('/auth-tables', function () {
    return view("sneat.html.tables-basic");
});
Route::get('/auth-accordion', function () {
    return view("sneat.html.ui-accordion");
});
Route::get('/auth-alerts', function () {
    return view("sneat.html.ui-alerts");
});
Route::get('/auth-badges', function () {
    return view("sneat.html.ui-badges");
});
Route::get('/auth-buttons', function () {
    return view("sneat.html.ui-buttons");
});
Route::get('/auth-carousels', function () {
    return view("sneat.html.ui-carousel");
});
Route::get('/auth-collapse', function () {
    return view("sneat.html.ui-collapse");
});
Route::get('/auth-dropdowns', function () {
    return view("sneat.html.ui-dropdowns");
});
Route::get('/auth-footer', function () {
    return view("sneat.html.ui-footer");
});
Route::get('/auth-list-group', function () {
    return view("sneat.html.ui-list-groups");
});
Route::get('/auth-modals', function () {
    return view("sneat.html.ui-modals");
});
Route::get('/auth-navbar', function () {
    return view("sneat.html.ui-navbar");
});
Route::get('/auth-offcanvas', function () {
    return view("sneat.html.ui-offcanvas");
});
Route::get('/auth-pagination', function () {
    return view("sneat.html.ui-pagination-breadcrumbs");
});
Route::get('/auth-progress', function () {
    return view("sneat.html.ui-progress");
});
Route::get('/auth-spinners', function () {
    return view("sneat.html.ui-spinners");
});
Route::get('/auth-tab-pills', function () {
    return view("sneat.html.ui-tabs-pills");
});
Route::get('/auth-toasts', function () {
    return view("sneat.html.ui-toasts");
});
Route::get('/auth-tooltips', function () {
    return view("sneat.html.ui-tooltips-popovers");
});
Route::get('/auth-typography', function () {
    return view("sneat.html.ui-typography");
});


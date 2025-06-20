<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Authentication;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\PodcastController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ResourceController;
use App\Http\Controllers\ServiceController;
use App\Models\User;
use Illuminate\Support\Facades\Route;












// 
Route::get("/login", function () {
    return view("login");
})->name("login")->middleware("guest");
Route::get("/register", function () {
    return view("register");
})->name("register")->middleware("guest");
Route::get("/admin/dashboard",function(){
    $users=User::where("isadmin", "0")->count();
    $admins=User::where("isadmin", "1")->count();  
    $categories=\App\Models\Category::all()->count();
    $posts=\App\Models\Post::all()->count();
    $events=\App\Models\Event::all()->count();
    $resources=\App\Models\Resource::all()->count();
    $services=\App\Models\Service::all()->count();
    $podcasts=\App\Models\Podcast::all()->count();
    $quizzes=\App\Models\Quiz::all()->count();
    // $questions=\App\Models\Question::all()->count();
    $data=[
        "users"=>$users,
        "admins"=>$admins,
        "categories"=>$categories,
        "posts"=>$posts,
        "events"=>$events,
        "resources"=>$resources,
        "services"=>$services,
        "podcasts"=>$podcasts,
        "quizzes"=>$quizzes,
        // "questions"=>$questions
    ];
    // dd($data);       

  return view("admin.index", $data);
})->middleware("auth")->name("admin.dashboard");

Route::middleware("auth")->group(function () {
    // 
    Route::post("/logout/auth", [Authentication::class, "logout"]);
    Route::post("/auth/changepassword", [Authentication::class, "changepassword"]);
    Route::post("/auth/profilechange", [Authentication::class, "uploadprofilepicture"]);
    // 
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
    Route::get("/admin/admin/create", [AdminController::class, "create"]);
    Route::post("/admin/admin/store", [AdminController::class, "store"]);
    Route::get("/admin/admin", [AdminController::class, "index"]);
    Route::get("/admin/admin/{admin}", [AdminController::class, "show"]);
    Route::put("/admin/admin/{admin}", [AdminController::class, "update"]);
    Route::delete("/admin/admin/{admin}", [AdminController::class, "destroy"]);
    Route::get("/admin/admin/{admin}/edit", [AdminController::class, "edit"]);
    // 
    Route::get("/admin/add-question/{quiz}", [QuestionController::class, "create"]);
    Route::post("/admin/add-question", [QuestionController::class, "store"]);
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
    Route::get("/admin/quiz/create", [QuizController::class, "create"]);
    Route::post("/admin/quiz/store", [QuizController::class, "store"]);
    Route::get("/admin/quiz", [QuizController::class, "index"]);
    Route::get("/admin/quiz/{quiz}", [QuizController::class, "show"]);
    Route::put("/admin/quiz/{quiz}", [QuizController::class, "update"]);
    Route::delete("/admin/quiz/{quiz}", [QuizController::class, "destroy"]);
    Route::get("/admin/quiz/{quiz}/edit", [QuizController::class, "edit"]);
    // 
    Route::get("/admin/question/create", [QuestionController::class, "create"]);
    Route::post("/admin/question/store", [QuestionController::class, "store"]);
    Route::post("/admin/add-question-label", [QuestionController::class, "addOptionLabel"]);
    Route::get("/admin/question", [QuestionController::class, "index"]);
    // Route::get("/admin/question/{question}", [QuestionController::class, "show"]);
    Route::put("/admin/question/{question}", [QuestionController::class, "update"]);
    Route::delete("/admin/question/{question}", [QuestionController::class, "destroy"]);
    Route::get("/admin/question/{question}/edit", [QuestionController::class, "edit"]);
    Route::get("/admin/view-question/{quiz}", [QuestionController::class, "show"]);
    Route::get('/admin/question/{id}/correct-answer', [QuestionController::class, 'getCorrectAnswer']);
    // 
    Route::get("/admin/profile", [ProfileController::class, "profile"]);
    // User
    Route::get("/user/profile", [ProfileController::class, "profile"]);
    Route::get("/user/event", [ClientController::class, "events"]);
    Route::get("/user/event/{event}", [ClientController::class, "showevent"]);
    Route::get("/user/podcast", [ClientController::class, "podcasts"]);
    Route::get("/user/podcast/{podcast}", [ClientController::class, "showpodcast"]);
    Route::get("/user/post", [ClientController::class, "posts"]);
    Route::get("/user/post/{post}", [ClientController::class, "showpost"]);
    Route::get("/user/resource", [ClientController::class, "resources"]);
    Route::get("/user/resource/{resource}", [ClientController::class, "showresource"]);
    Route::get("/user/quiz", [ClientController::class, "quizzes"]);
    Route::get("/user/quiz/{quiz}", [ClientController::class, "showquiz"]);
    Route::get("/user/service", [ClientController::class, "services"]);
    Route::get("/user/service/{service}", [ClientController::class, "showservice"]);
    Route::get("/user/quiz", [ClientController::class, "showquiz"]);
    Route::get("/user/view-question/{quiz}", [ClientController::class, "showquestions"]);
});


Route::post("/login/auth", [Authentication::class, "login"]);
Route::post("/register/auth", [Authentication::class, "register"]);
// 

// 
Route::get('/', function () {
    return view("welcome");
})->name("home");







// template
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


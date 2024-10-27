<?php

use App\Http\Controllers\DispatchController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\WorkerController;
use App\Models\Event;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::prefix("/admin")->group(function () {
    Route::middleware("guest")->group(function () {
        Route::get("/login", [LoginController::class, "login"])->name("login");
        Route::post("/login", [LoginController::class, "check"])->name("check");
    });
    Route::middleware(["auth", "cache.headers:no_store"])->group(function () {
        Route::get("/dashboard", function () {
            return view("dashboard");
        })->name("dashboard");
        Route::get("/logout", [LoginController::class, "logout"])->name("logout");
        Route::get("/event/index", [EventController::class, "index"])->name("event_index");
        Route::get("/event/create", [EventController::class, "create"])->name("event_create");
        Route::post("/event/store", [EventController::class, "store"])->name("event_store");
        Route::get("/event/edit/{id}", [EventController::class, "edit"])->name("event_edit");
        Route::post("/event/update/{id}", [EventController::class, "update"])->name("event_update");
        Route::get("/event/destroy/{id}", [EventController::class, "destroy"])->name("event_destroy");

        Route::get("/worker/index", [WorkerController::class, "index"])->name("worker_index");
        Route::get("/worker/create", [WorkerController::class, "create"])->name("worker_create");
        Route::post("/worker/store", [WorkerController::class, "store"])->name("worker_store");
        Route::get("/worker/edit/{id}", [WorkerController::class, "edit"])->name("worker_edit");
        Route::post("/worker/update/{id}", [WorkerController::class, "update"])->name("worker_update");
        Route::get("/worker/destroy/{id}", [WorkerController::class, "destroy"])->name("worker_destroy");

        Route::get("/dispatch/index", [DispatchController::class, "index"])->name("dispatch_index");
        Route::get("/dispatch/create", [DispatchController::class, "create"])->name("dispatch_create");
        Route::post("/dispatch/store", [DispatchController::class, "store"])->name("dispatch_store");
        Route::get("/dispatch/edit/{id}", [DispatchController::class, "edit"])->name("dispatch_edit");
        Route::post("/dispatch/update/{id}", [DispatchController::class, "update"])->name("dispatch_update");
        Route::get("/dispatch/destroy/{id}", [DispatchController::class, "destroy"])->name("dispatch_destroy");
    });
});

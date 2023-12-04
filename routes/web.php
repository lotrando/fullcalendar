<?php

use App\Http\Controllers\EventController;
use App\Models\Department;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    $departments = Department::all();
    return view('welcome', ['departments' => $departments]);
});

Route::get('events', [EventController::class, 'calendarIndex'])->name('events.index');
Route::post('event', [EventController::class, 'calendarStore'])->name('event.store');
Route::get('event/{id}', [EventController::class, 'calendarShow'])->name('event.show');
Route::post('event/update/{id}', [EventController::class, 'calendarUpdate'])->name('event.update');
Route::delete('event/destroy/{id}', [EventController::class, 'calendarDestroy'])->name('event.destroy');

Route::get('table', [EventController::class, 'tableIndex'])->name('table.index');

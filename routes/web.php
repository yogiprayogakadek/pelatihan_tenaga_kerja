<?php

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

Route::middleware('auth')->group(function() {
    Route::get('/', 'Main\DashboardController@index')->name('dashboard');
    
    Route::namespace('Main')->group(function() {
        // Assessor Route
        Route::controller(AssessorController::class)
            ->prefix('assessor')
            ->as('assessor.')
            ->group(function(){
                Route::get('', 'index')->name('index');
                Route::get('/render', 'render')->name('render');
                Route::get('/create', 'create')->name('create');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::post('/update', 'update')->name('update');
        });
    
        // Class Route
        Route::controller(ClassController::class)
            ->prefix('class')
            ->as('class.')
            ->group(function(){
                Route::get('', 'index')->name('index');
                Route::get('/render', 'render')->name('render');
                Route::get('/create', 'create')->name('create');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::post('/update', 'update')->name('update');
        });
    
        // Announcement Route
        Route::controller(AnnouncementController::class)
            ->prefix('announcement')
            ->as('announcement.')
            ->group(function(){
                Route::get('', 'index')->name('index');
                Route::get('/render', 'render')->name('render');
                Route::get('/create', 'create')->name('create');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::post('/update', 'update')->name('update');
            });
            
            // Participant Route
            Route::controller(ParticipantController::class)
            ->prefix('participant')
            ->as('participant.')
            ->group(function(){
                Route::get('', 'index')->name('index');
                Route::get('/render', 'render')->name('render');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/upload', 'upload')->name('upload');
        });
    });
});

Route::namespace('Main')->middleware('guest')->group(function() {
    // Registration Route
    Route::controller(RegistrationController::class)
    ->prefix('registration')
    ->as('registration.')
    ->group(function(){
        Route::get('', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
});
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

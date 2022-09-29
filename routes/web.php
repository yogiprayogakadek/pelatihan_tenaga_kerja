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
                Route::get('/render/participant', 'participant')->name('participant');
                Route::get('/render/attendance/{class_id}', 'attendance')->name('attendance');
                Route::get('/render/create-attendance/{class_id}/{meeting_number}', 'createAttendance')->name('create.attendance');
                Route::get('/create', 'create')->name('create');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::post('/update', 'update')->name('update');
                Route::post('/process-attendance', 'processAttendance')->name('process.attendance');
                
                // route for participant
                Route::get('/participant-attendance', 'participantAttendance')->name('participant.attendance');
                Route::get('/certificate', function() {
                    return view('main.certificate.index');
                });
                
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
                Route::get('/detail/{id}', 'detail')->name('detail');
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
                Route::post('/update', 'update')->name('update');
                Route::post('/upload', 'upload')->name('upload');
                
                // document for participant
                Route::get('/document', 'document')->name('document');
            });

        // Assessment Route
        Route::controller(AssessmentController::class)
            ->prefix('assessment')
            ->as('assessment.')
            ->group(function(){
                Route::get('', 'index')->name('index');
                Route::get('/render', 'render')->name('render');
                Route::get('/create', 'create')->name('create');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::post('/update', 'update')->name('update');

                Route::get('/render/{class_id}/participant/', 'participant')->name('participant');
            });

        // Payment Route
        Route::controller(PaymentController::class)
            ->prefix('payment')
            ->as('payment.')
            ->group(function(){
                Route::get('', 'index')->name('index');
                Route::get('/render', 'render')->name('render');
                Route::get('/create', 'create')->name('create');
                Route::get('/edit/{id}', 'edit')->name('edit');
                Route::post('/store', 'store')->name('store');
                Route::post('/update', 'update')->name('update');
            });

        // Payment Route
        Route::controller(CertificateController::class)
            ->prefix('certificate')
            ->as('certificate.')
            ->group(function(){
                Route::get('', 'index')->name('index');
                Route::get('/download', 'generateCertificate')->name('download');
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

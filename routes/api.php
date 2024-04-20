<?php

use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\apiMessageController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function (){

    Route::get('/dashboard/users', [AuthController::class, 'viewUsers']);

    Route::get('/blog', [apiMessageController::class, 'show']);

    Route::post('/user/logout', [AuthController::class, 'logout']);
    Route::get('/search/{title}', [apiMessageController::class, 'search']);
});


//
//Route::get('/email/verify', function () {
//    return view('auth.verify-email');
//})->middleware('auth')->name('verification.notice');

//
//Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
//    $request->fulfill();
//
////    return redirect('/login');
//    return redirect('/home');
//})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});

Route::get('/email/verify/{id}/{hash}', function (Request $request, $id, $hash) {
    // Authenticate the user
    if (!Auth::check()) {
        return response()->json(['error' => 'Unauthenticated'], 401);
    }

    // Fulfill the email verification request
    $request->user()->markEmailAsVerified();

    return response()->json(['message' => 'Email verified successfully']);
})->middleware(['auth:sanctum', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');




Route::get('/blog/search/{title}', [apiMessageController::class, 'search']);

Route::post('/user/register', [AuthController::class, 'register']);
Route::post('/user/login', [AuthController::class, 'login']);


//Route::resource('/', \App\Http\Controllers\apiMessageController::class);
Route::post('/blog/create', [apiMessageController::class, 'create']);

//Route::get('/blog', [apiMessageController::class, 'show']);

Route::get('/blog/{id}', [apiMessageController::class, 'view']);

Route::put('/blog/{id}', [apiMessageController::class, 'update']);

Route::delete('/blog/{id}', [apiMessageController::class, 'destroy']);

//Route::get('/search/{title}', [apiMessageController::class, 'search']);

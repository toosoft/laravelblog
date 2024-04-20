<?php

use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;

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
//Route::get('/about', 'App\Http\Controllers\HomeController@index');


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum']], function (){
//    Route::post('/logout', [AuthController::class, 'logout']);
//    Route::get('/search/{title}', [apiMessageController::class, 'search']);


//    Route::get('/', [HomeController::class, 'index']);

    Route::get('/blog', [HomeController::class, 'blog']);

    Route::post('/blog/create', [MessageController::class, 'create']);

    Route::get('/blog/message/{id}', [MessageController::class, 'view']);


});


//Route::get('/csrf-token', function () {
//    return response()->json(['csrf_token' => csrf_token()]);
//});

Route::get('/csrf-token', function (Request $request) {
    $token = $request->session()->token();

    logger()->info($token);
    $token = csrf_token();
    return ['csrf_token' => $token];

    // ...
});

Route::get('/', [HomeController::class, 'index']);


Route::get('/register', function (Request $request) {

    return view('register'); // Load the register form view
})->name('register');


Route::post('/register', [AuthController::class, 'webregister']);


Route::get('/login', function () {
    return view('login'); // Load the login form view
})->name('login');

Route::post('/logout', [AuthController::class, 'weblogout'])->name('logout');

//Route::post('/login', function (Request $request) {
//    // Validate login credentials and authenticate the user
//    // Logic to handle user authentication
//    // Redirect the user after successful login
//    return redirect('/home');
//});

//Route::post('/login', [AuthController::class, 'login']);
Route::post('/login', function (Request $request) {
    // Validate the user's login credentials
    $credentials = $request->only('email', 'password');
    if (Auth::attempt($credentials)) {
        // Authentication successful, redirect the user to the intended page
        return redirect()->intended('/dashboard');
    } else {
        // Authentication failed, redirect the user back with an error message
        return back()->withInput()->withErrors(['email' => 'Invalid credentials']);
    }
});


Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');


Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');




//Auth::Routes([
//    'verify' => true
//]);

//
//Route::get('/', [HomeController::class, 'index']);
//
//Route::get('/blog', [HomeController::class, 'blog']);
//
//Route::post('/blog/create', [MessageController::class, 'create']);
//
//Route::get('/blog/message/{id}', [MessageController::class, 'view']);

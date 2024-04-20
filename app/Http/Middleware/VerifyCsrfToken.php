<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
        '/api/user/register',
        '/api/user/login',
        '/api/user/logout',

//        'login', // Route for login
//        'user/register', // Route for registration
//        'register', // Route for registration
    
    ];
}

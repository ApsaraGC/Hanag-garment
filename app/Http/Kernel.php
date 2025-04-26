<?php
namespace App\Http;

use App\Http\Middleware\Authenticate;
use App\Http\Middleware\AuthAdmin;
use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    // Register custom middleware aliases
    protected $middlewareAliases = [
        'auth.admin' => \App\Http\Middleware\AuthAdmin::class,
    ];

    // Other default properties
}


<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        // This middleware is for specifying which hosts the application should trust.
        // It's commented out, so it's currently inactive.

        \App\Http\Middleware\TrustProxies::class,
        // This middleware is for behind-load-balancer setups like AWS Elastic Load Balancing.
        // It's responsible for updating the request instances to be aware of proxies in terms of HTTP scheme, port, and address.

        \Illuminate\Http\Middleware\HandleCors::class,
        // Handles Cross-Origin Resource Sharing (CORS) settings, which is a mechanism that allows 
        // or denies web resources to interact with each other across origins (domains).

        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        // Prevents any HTTP requests when the application is in maintenance mode.

        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        // Validates the size of the POST data to ensure that it doesn't exceed the maximum upload size specified in the PHP configuration.

        \App\Http\Middleware\TrimStrings::class,
        // Automatically trims incoming string data in the request, which includes removing any extra white-space from the beginning and end of the string.

        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
        // Converts any empty string values in the request input data to null. This is useful for 
        // database normalization.
    ];


    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class, // Add queued cookies to response is used to add cookies to the response
            \Illuminate\Session\Middleware\StartSession::class, // Start session is used to store data in the session
            \Illuminate\View\Middleware\ShareErrorsFromSession::class, // Share errors from session is used to display errors in the view
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class, // Substitute bindings is used to inject models into routes
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class.':api', // Throttle requests is used to limit the number of requests to the API
            \Illuminate\Routing\Middleware\SubstituteBindings::class, // Substitute bindings is used to inject models into routes
        ],
    ];

    /**
     * The application's middleware aliases.
     *
     * Aliases may be used instead of class names to conveniently assign middleware to routes and groups.
     *
     * @var array<string, class-string|string>
     */
    protected $middlewareAliases = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'precognitive' => \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class,
        'signed' => \App\Http\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];
}

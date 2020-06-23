<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $addHttpCookie = true;
    protected $except = [
        //
        'api/add_to_cart',
        'api/empty_cart',
        'api/apply_promo',
        'api/place_order',
    ];
}

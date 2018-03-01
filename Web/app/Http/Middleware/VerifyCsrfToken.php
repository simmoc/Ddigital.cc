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
    protected $except = [
        'cart/paypal/status-success',
		'cart/payu/status-success',
		'cart/payu/status-cancel',
		'coupon/apply',
    ];
}

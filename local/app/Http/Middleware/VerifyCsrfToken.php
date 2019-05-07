<?php

namespace Responsive\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as BaseVerifier;

class VerifyCsrfToken extends BaseVerifier
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array
     */
    protected $except = [
        'payu_failed/*',
		'payu_success/*',
		'feature-success/*',
		'payu-feature-success/*',
		'payu-fund-success/*',
		'payment_status',
    ];
	
	
	
}

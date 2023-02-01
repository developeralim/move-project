<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class MemberCheckMiddlware extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if ( $request->expectsJson() ) {
            return route('dashboard');
        }
    }

    protected function authenticate($request, array $guards)
    {

        if ($this->auth->guard('member')->check()) {
            return $this->auth->shouldUse('member');
        }

        $this->unauthenticated($request, ['member']);
    }
}

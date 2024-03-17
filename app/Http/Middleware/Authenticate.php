<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('login');
    }

    /**
     * Redirect unauthenticated users to the home page.
     */
    protected function redirectToUnauthenticatedRequest(Request $request): string
    {
        return $request->expectsJson() ? '' : route('login');
    }
}

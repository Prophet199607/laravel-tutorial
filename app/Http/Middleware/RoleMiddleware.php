<?php

namespace App\Http\Middleware;

use Closure;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if ($request->age > 20) {
            return $next($request);
        }
        return response()->json(['message' => 'Unauthorized'], 401);
        return redirect()->route('post.index');
    }
}

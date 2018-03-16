<?php namespace Bantenprov\VueTrust\Http\Middleware;

use Closure;

/**
 * The VueTrustMiddleware class.
 *
 * @package Bantenprov\VueTrust
 * @author  bantenprov <developer.bantenprov@gmail.com>
 */
class VueTrustMiddleware
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
        return $next($request);
    }
}

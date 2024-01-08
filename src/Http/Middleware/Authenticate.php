<?php

namespace Tallerrs\BharPhyit\Http\Middleware;

use Tallerrs\BharPhyit\BharPhyit;
use Tallerrs\BharPhyit\Exceptions\ForbiddenException;

class Authenticate
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return \Illuminate\Http\Response|null
     */
    public function handle($request, $next)
    {
        if (!BharPhyit::check($request)) {
            throw ForbiddenException::make();
        }

        return $next($request);
    }
}

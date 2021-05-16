<?php

namespace App\Http\Middleware;

use Illuminate\Session\Middleware\StartSession;
use Closure;
use Illuminate\Http\Request;

class ManagerSession extends StartSession
{
    const MANAGER_SESSION_NAME = 'zbs_session';

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (! $this->sessionConfigured()) {
            return $next($request);
        }

        $session = $this->getSession($request);
        $session->setName(self::MANAGER_SESSION_NAME);

        if ($this->manager->shouldBlock() ||
            ($request->route() instanceof Route && $request->route()->locksFor())) {
            return $this->handleRequestWhileBlocking($request, $session, $next);
        } else {
            return $this->handleStatefulRequest($request, $session, $next);
        }
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @return void
     */
    public function getSession(Request $request)
    {
        return tap($this->manager->driver(), function ($session) use ($request) {
            $session->setId($request->cookies->get(self::MANAGER_SESSION_NAME));
        });
    }
}

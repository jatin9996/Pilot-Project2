<?php

namespace App\Http\Middleware;

use App\Enums\StatusEnum;
use App\Enums\UserType;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckAdminLogin
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $auth = auth()->guard('admin');
        if (!$auth->check()) {
            Session::flash('error', __('messages.requestInvalidHttp'));
            return redirect('/');
        }

        return $next($request);
    }
}

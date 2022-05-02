<?php

namespace App\Http\Middleware;

use App\Enums\UserType;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

/**
 * Class AdminUser
 * @package App\Http\Middleware
 */
class AdminUser
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
        $auth = auth()->guard('admin')->user();
        if ($auth['type'] === UserType::USER) {
            Session::flash('error', __('messages.requestInvalidHttp'));
            return redirect('/');
        }
        return $next($request);
    }
}

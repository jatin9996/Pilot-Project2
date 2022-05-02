<?php

namespace App\Http\Middleware;

use App\Enums\UserType;
use Closure;
use Illuminate\Http\Request;

class CheckAdminWithoutLogin
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
        if ($auth->check()) {
            $user = $auth->user();
            if ($user['type'] === UserType::ADMIN) {
                return redirect()->route('admin.users.index');
            } else {
                return redirect()->route('admin.products.index');
            }
        }
        return $next($request);
    }
}

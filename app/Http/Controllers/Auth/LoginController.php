<?php

namespace App\Http\Controllers\Auth;

use App\Enums\StatusEnum;
use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * Class LoginController
 * @package App\Http\Controllers\Auth
 */
class LoginController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(LoginRequest $request)
    {
        try {
            /** @var  $credentials */
            $credentials = $request->validated();

            /** @var  $remember */
            $remember = ($request->remember != null && $request->remember === "on") ? true : false;

            /** Login Auth */
            if (Auth::guard('admin')->attempt($credentials, $remember)) {
                $auth = Auth::guard('admin')->user();

                session()->flash('success', __('messages.loginSuccess', ['name' => $auth['first_name'] . ' ' . $auth['last_name']])); // Session Flash Msg return
                if ($auth['type'] === UserType::ADMIN) {
                    return redirect()->route('admin.users.index');
                } else {
                    return redirect()->route('admin.products.index');
                }
            }

            session()->flash('error', __('messages.authFailed')); // Session Flash Msg return
            return back()->withInput($request->only('email', 'remember'))->withErrors(["email" => __('messages.authFailed')]);
        } catch (\Exception $e) {
            // Error return
            session()->flash('error', __('messages.serverError'));
            return redirect()->back()->withInput();
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}

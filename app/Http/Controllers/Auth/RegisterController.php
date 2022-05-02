<?php

namespace App\Http\Controllers\Auth;

use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

/**
 * Class RegisterController
 * @package App\Http\Controllers\Auth
 */
class RegisterController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * @param RegisterRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function register(RegisterRequest $request)
    {
        try {
            /** @var  $input */
            $input = collect($request->validated())->put('type', UserType::USER)->all();
            $input['password'] = Hash::make($input['password']);
            /** user Create */
            User::create($input);

            session()->flash('success', __('messages.registerSuccess')); // Session Flash Msg return
            return redirect()->route('admin.login');
        } catch (\Exception $e) {
            session()->flash('error', __('messages.serverError'));// Error return
            return redirect()->back()->withInput();
        }
    }
}

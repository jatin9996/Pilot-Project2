<?php

namespace App\Http\Controllers\User;

use App\Enums\UserType;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\User\StoreRequest;
use App\Http\Requests\User\UpdateRequest;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserController
 * @package App\Http\Controllers\User
 */
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRequest $request)
    {
        try {
            /** @var  $input */
            $input = $request->validated();

            /** User Create */
            User::create(array(
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'email' => $input['email'],
                'password' => Hash::make($input['password']),
                'type' => UserType::USER,
            ));

            session()->flash('success', __('messages.addUserSuccess', ['name' => $input['first_name'] . ' .' . $input['last_name']])); // Session Flash Msg return
            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            session()->flash('error', __('messages.serverError')); // Error return
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, User $user)
    {
        try {
            /** @var  $input */
            $input = $request->validated();

            /** @var  $updateArr */
            $updateArr = array(
                'first_name' => $input['first_name'],
                'last_name' => $input['last_name'],
                'email' => $input['email']
            );

            if (isset($input['password'])) { // If Password so entry in if condition
                $updateArr['password'] = Hash::make($input['password']);
            }
            $user->update($updateArr);

            session()->flash('success', __('messages.updateUserSuccess', ['name' => $input['first_name'] . ' .' . $input['last_name']])); // Session Flash Msg return
            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            session()->flash('error', __('messages.serverError')); // Error return
            return redirect()->back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();
            return response()->json(array(
                'status' => "success",
                'message' => __('messages.deleteUserSuccess'),
            ));
        } catch (\Exception $e) {
            return response()->json(array(
                'status' => "error",
                'message' => __('messages.serverError'),
            ));
        }
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\UserResourceCollection;
use App\User;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Log;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(new UserResourceCollection(User::all()));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'bail|required|max:255',
            'email' => 'bail|required|max:255|email|unique:users,email',
            'password' => 'bail|required'
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        Log::info("User ID {$user->id} created successfully.");

        return response(new UserResource($user), Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return response(new UserResource($user));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'bail|required|max:255',
            'email' => 'bail|required|max:255|email|unique:users,email,'.$user->id
        ]);

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->save();

        Log::info("User ID {$user->id} updated successfully.");

        return response(new UserResource($user));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(User $user)
    {
        $user->delete();

        Log::info("User ID {$user->id} deleted successfully.");

        return response(null, Response::HTTP_NO_CONTENT);
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Models\User;

class UserController extends Controller
{
    function index(){
        $user = User::all();
        return response()->json($user);
    }

    function store(StoreUserRequest $request){
        try {
            $data = $request->validated();
            $user = new User;
            $user->user_name = $data['user_name'];
            $user->user_email = $data['user_email'];
            $user->user_phone = $data['user_phone'];
            $user->user_address = $data['user_address'];
            $user->save();

            return $user;
        } catch (\Throwable $th) {
            return response($th->getMessage(), 500);
        }
    }

    function update(StoreUserRequest $request, $id){
        try {
            $data = $request->validated();
            $user = User::findOrFail($id);
            $user->user_name = $data['user_name'];
            $user->user_email = $data['user_email'];
            $user->user_phone = $data['user_phone'];
            $user->user_address = $data['user_address'];
            $user->save();

            return $user;
        } catch (\Throwable $th) {
            return response($th->getMessage(), 500);
        }
    }

    function destroy($id){
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return true;
        } catch (\Throwable $th) {
            return response($th->getMessage(), 500);
        }
    }
}

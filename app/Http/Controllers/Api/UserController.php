<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
//  TODO: реализовать валидацию
    public function register(Request $request): \Illuminate\Http\JsonResponse
    {

        $user = new User();
        $user->name = $request->name;
        $user->lastname = $request->lastname;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);

        if($user->save()) {
            $success = true;
            $message = 'Пользователь успешно зарегистрирован!';
        } else {
            $success = false;
            $message = 'Ошибка при регистрации пользователя!';
        }

        return response()->json(compact('success', 'message'));
    }


    public function login(UserLoginRequest $request): \Illuminate\Http\JsonResponse
    {

        $validated = $request->validated();

        $credentials = [
            'email' => $validated['email'],
            'password' => $validated['password'],
        ];

        if (Auth::attempt($credentials)) {
            $success = true;
            $message = 'Вы успешно авторизованы!';
        } else {
            $success = false;
            $message = 'Ошибка при авторизации пользователя!';
        }

        return response()->json(compact('success', 'message'));
    }


    public function logout(): \Illuminate\Http\JsonResponse
    {
        try {
            Session::flush();
            $success = true;
            $message = 'Successfully logged out';
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }

        return response()->json(compact('success', 'message'));
    }
}

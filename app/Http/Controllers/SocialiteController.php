<?php

namespace App\Http\Controllers;

use App\Services\SocialiteService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Laravel\Socialite\Facades\Socialite;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SocialiteController extends Controller
{

    public function init(): RedirectResponse
    {
        return Socialite::driver('vkontakte')->redirect();
    }

    public function callback(SocialiteService $service): JsonResponse|\Illuminate\Http\RedirectResponse
    {
        $user = Socialite::driver('vkontakte')->user();

        if($service->login($user)) {

            $token = Auth::user()->createToken('LaravelSanctumAuth')->plainTextToken;

            $user = Auth::user();

            $redis = Redis::connection();

            $redis->set('socialite' . csrf_token(), json_encode(['user' => $user, 'token' => $token]), 'EX', 300);

            return redirect()->route('main', '/socialite');
        }

        return redirect('/login');


    }
}

<?php declare(strict_types=1);


namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Contracts\User as UserAuth2;

class SocialiteService
{
    public function login(UserAuth2 $user): bool|array
    {
        $email = $user->getEmail();
        $name = $user->getName();

        $userDataBase = User::firstOrCreate(['email' => $email], [
            'email' => $email,
            'name' => $name,
            'lastname' => $user->last_name ?? " ",
            'password' => Hash::make('password'),
        ]);

        $credentials = [
            'email' => $userDataBase->email,
            'password' => ('password'),
        ];

        return Auth::attempt($credentials);

    }
}

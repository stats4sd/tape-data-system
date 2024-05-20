<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Http;
use Stats4sd\FilamentOdkLink\Services\OdkLinkService;

class OdkCentralUser
{
    // Log the user into ODK Central
    public function login(string $email, string $password): bool
    {
        $token = app()->make(OdkLinkService::class)->authenticate();
        $password = $this->padPassword($password);

        $response = Http::withToken($token)
            ->post(config('filament-odk-link.odk.base_endpoint') . '/sessions', [
                'email' => $email,
                'password' => $password,
            ])
            ->throw();

        session()->put('odk_central_cookies', $response->cookies());

        ray($response->cookies());

        return $response->ok();
    }

    // Log the user out of ODK Central
    public function logout(User $user)
    {
    }

    // register a new User on ODK Central
    public function register(string $email, string $password): string
    {


        $token = app()->make(OdkLinkService::class)->authenticate();
        $password = $this->padPassword($password);

        // obscure email so the end user doesn't get confusing emails form ODK Central.
        // The idea is that the user will never need to log into ODK Central directly.
        $email = md5($email) . '@example.com';

        $response = Http::withToken($token)
            ->post(config('filament-odk-link.odk.base_endpoint') . '/users', [
                'email' => $email,
                'password' => $password,
            ])
            ->throw()
            ->json();

        return $response['email'];


    }

    // update password if the user's password is ever updated...
    public function update(User $user)
    {

    }

    public function padPassword(string $password): string
    {
        if (strlen($password) < 10) {
            $password = str_pad($password, 10, '0');
        }

        return $password;
    }

}

<?php

namespace App\Http\Responses;

use Filament\Facades\Filament;
use Filament\Http\Responses\Auth\LoginResponse;
use GuzzleHttp\Cookie\CookieJar;
use GuzzleHttp\Cookie\SetCookie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cookie;
use Livewire\Features\SupportRedirects\Redirector;

class LoginResponseWithOdkCentralCookies extends LoginResponse
{
    public function toResponse($request): RedirectResponse|Redirector
    {
        return redirect()->intended(Filament::getUrl());
    }
}

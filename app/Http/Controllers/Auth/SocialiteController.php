<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    /**
     * Redirect the user to the provider's authentication page.
     */
    public function redirect(string $provider)
    {
        $this->validateProvider($provider);

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from the provider and log them in.
     */
    public function callback(string $provider)
    {
        $this->validateProvider($provider);

        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            return redirect()
                ->route("login")
                ->with(
                    "error",
                    "Unable to authenticate with " .
                        ucfirst($provider) .
                        ". Please try again.",
                );
        }

        $user = User::findOrCreateFromSocial($provider, $socialUser);

        Auth::login($user, true);

        return redirect()
            ->intended(route("f1.dashboard"))
            ->with("success", "Welcome back, " . $user->name . "!");
    }

    /**
     * Validate that the provider is supported.
     */
    protected function validateProvider(string $provider): void
    {
        $supported = ["google"];

        if (!in_array($provider, $supported)) {
            abort(404, "Provider '{$provider}' is not supported.");
        }
    }
}

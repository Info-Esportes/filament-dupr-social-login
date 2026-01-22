<?php

namespace InfoEsportes\FilamentDuprSocialLogin\Middlewares;

use Closure;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use InfoEsportes\Dupr\PartnerApi\Client;
use InfoEsportes\FilamentDuprSocialLogin\Contracts\HasDUPR;
use InfoEsportes\FilamentDuprSocialLogin\FilamentDuprSocialLoginPlugin;

class DUPRSocialLoginMiddleware
{
    /**
     * Handle an incoming request.
     * This middleware runs after authentication but before tenant loading.
     */
    public function handle(Request $request, Closure $next)
    {
        if (($panel = filament()->getCurrentPanel()) && $panel->hasPlugin('filament-dupr-plugin')) {
            // Proceed with DUPR authentication check

            if ($user = Auth::user()) {
                if (! ($user instanceof HasDUPR)) {
                    $modelClass = $user::class;
                    $contractClass = HasDUPR::class;

                    throw new \LogicException("The model [{$modelClass}] does not implement the [{$contractClass}] contract required for DUPR social login.");
                }

                // Check if this is the DUPR verification route itself
                if ($request->routeIs("filament.{$panel->getId()}.pages.dupr.verify")) {
                    return $next($request);
                }

                // Check if user has verified DUPR authentication
                // You can customize this check based on your implementation

                $needVerification = $this->needsDuprAuthentication(
                    plugin: $panel->getPlugin('filament-dupr-plugin'),
                    request: $request,
                    user: $user
                );

                if ($needVerification) {
                    // Redirect to DUPR verification page
                    // Using Redirect::guest() to remember the intended URL
                    return Redirect::guest(URL::route("filament.{$panel->getId()}.pages.dupr.verify"));
                }
            }
        }

        return $next($request);
    }

    /**
     * Check if the user has authenticated with DUPR.
     */
    protected function needsDuprAuthentication(
        FilamentDuprSocialLoginPlugin $plugin,
        HasDUPR & Authenticatable $user,
        Request $request
    ): bool {
        if ($duprId = $user->getDuprId()) {
            if (! empty($request->session()->only(["dupr_{$duprId}_data"]))) {
                return false;
            }

            $client = new Client(
                clientKey: $plugin->getClientKey(),
                clientSecret: $plugin->getClientSecret(),
                environment: $plugin->isProduction() ? Client::ENV_PRODUCTION : Client::ENV_UAT,
                timeout: 60
            );

            $response = $client->users()->getUserInfo($duprId);

            if ($response->isSuccess()) {
                $request->session()->put("dupr_{$duprId}_data", $response->get('result'));

                return false;
            }
        }

        return true;
    }
}

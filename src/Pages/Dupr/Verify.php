<?php

namespace InfoEsportes\FilamentDuprSocialLogin\Pages\Dupr;

use Filament\Notifications\Notification;
use Filament\Pages\Concerns;
use Filament\Pages\SimplePage;
use Illuminate\Support\Arr;
use InfoEsportes\FilamentDuprSocialLogin\Contracts\HasDUPR;

/**
 * Component to check if the authenticated user is currenctly connected
 * with the DUPR social network.
 */
class Verify extends SimplePage
{
    use Concerns\CanUseDatabaseTransactions;

    protected string $view = 'filament-dupr-social-login::pages.dupr.verify';

    protected static string $layout = 'filament-dupr-social-login::components.layout.fullscreen';

    public function getIframeSrc(): ?string
    {
        if (($panel = filament()->getCurrentPanel()) && $panel->hasPlugin('filament-dupr-social-login')) {
            /** @var \InfoEsportes\FilamentDuprSocialLogin\FilamentDuprSocialLoginPlugin $plugin */
            $plugin = $panel->getPlugin('filament-dupr-social-login');

            if ($clientKey = $plugin->getClientKey()) {
                $base64 = base64_encode($clientKey);

                return match ($plugin->isProduction()) {
                    true => 'https://dashboard.dupr.com/login-external-app/',
                    false => 'https://uat.dupr.gg/login-external-app/',
                } . $base64;
            }
        }

        return null;
    }

    public function handleDuprLogin(array $data): void
    {
        // Validate required fields
        if (empty($data['userToken']) || empty($data['refreshToken'])) {
            Notification::make()
                ->title('Login failed')
                ->body('Invalid authentication data received from DUPR.')
                ->danger()
                ->send();

            return;
        }

        // Get the plugin to access any custom handlers
        if (($panel = filament()->getCurrentPanel()) && $panel->hasPlugin('filament-dupr-social-login')) {
            if (($user = auth($panel->getAuthGuard())->user()) && $user instanceof \InfoEsportes\FilamentDuprSocialLogin\Contracts\HasDUPR) {
                /** @var \Illuminate\Contracts\Auth\Authenticatable&\Illuminate\Database\Eloquent\Model&HasDUPR $user */
                $user->setDuprId(Arr::get($data, 'duprId'));
                $user->setDuprUserToken(Arr::get($data, 'userToken'));
                $user->setDuprRefreshToken(Arr::get($data, 'refreshToken'));
                $user->save();
            }

            Notification::make()
                ->title('Successfully connected to DUPR')
                ->body('Your DUPR account has been linked successfully.')
                ->success()
                ->send();

            // Redirect back to the previous page or dashboard
            $this->redirect(filament()->getUrl());
        }
    }
}

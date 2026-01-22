<?php

use Filament\Facades\Filament;
use Illuminate\Support\Facades\Route;
use InfoEsportes\FilamentDuprSocialLogin\FilamentDuprSocialLoginPlugin;
use InfoEsportes\FilamentDuprSocialLogin\Pages\Dupr\Verify;

use function Illuminate\Filesystem\join_paths;

Route::name('filament.')->group(function () {
    foreach (Filament::getPanels() as $panel) {
        $domains = $panel->getDomains();

        foreach ((empty($domains) ? [null] : $domains) as $domain) {
            Route::domain($domain)
                ->middleware($panel->getMiddleware())
                ->name($panel->getId() . '.')
                ->prefix($panel->getPath())
                ->group(function () use ($panel) {
                    if ($panel->hasPlugin('filament-dupr-social-login')) {
                        /** @var FilamentDuprSocialLoginPlugin $plugin */
                        $plugin = $panel->getPlugin('filament-dupr-social-login');

                        Route::get(join_paths($plugin->getSlug(), 'verify'), Verify::class)->name('pages.dupr.verify');
                    }
                });
        }
    }
});

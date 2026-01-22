<?php

namespace InfoEsportes\FilamentDuprSocialLogin;

use Filament\Support\Assets\AlpineComponent;
use Filament\Support\Assets\Asset;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Filament\Support\Facades\FilamentIcon;
use Illuminate\Filesystem\Filesystem;
use Livewire\Features\SupportTesting\Testable;
use Livewire\Livewire;
use Spatie\LaravelPackageTools\Commands\InstallCommand;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use InfoEsportes\FilamentDuprSocialLogin\Commands\FilamentDuprSocialLoginCommand;
use InfoEsportes\FilamentDuprSocialLogin\Pages\Dupr\Verify;
use InfoEsportes\FilamentDuprSocialLogin\Testing\TestsFilamentDuprSocialLogin;

class FilamentDuprSocialLoginServiceProvider extends PackageServiceProvider
{
    public static string $name = 'filament-dupr-social-login';

    public static string $viewNamespace = 'filament-dupr-social-login';

    public function configurePackage(Package $package): void
    {
        $package
            ->name(static::$name)
            ->hasViews()
            ->hasRoute('web')
            ->hasInstallCommand(function (InstallCommand $command) {
                $command
                    ->copyAndRegisterServiceProviderInApp()
                    ->askToStarRepoOnGitHub('Info-Esportes/filament-dupr-social-login');
            });

        $configFileName = $package->shortName();

        // if (file_exists($package->basePath("/../config/{$configFileName}.php"))) {
        //     $package->hasConfigFile();
        // }

        // if (file_exists($package->basePath('/../database/migrations'))) {
        //     $package->hasMigrations($this->getMigrations());
        // }

        if (file_exists($package->basePath('/../resources/lang'))) {
            $package->hasTranslations();
        }

        if (file_exists($package->basePath('/../resources/views'))) {
            $package->hasViews(static::$viewNamespace);
        }
    }

    public function packageRegistered(): void {}

    public function packageBooted(): void
    {
        Livewire::component('infoesportes.filament-dupr-social-login.pages.dupr.verify', \InfoEsportes\FilamentDuprSocialLogin\Pages\Dupr\Verify::class);

        // Asset Registration
        FilamentAsset::register(
            $this->getAssets(),
            $this->getAssetPackageName()
        );

        FilamentAsset::registerScriptData(
            $this->getScriptData(),
            $this->getAssetPackageName()
        );

        // Icon Registration
        // FilamentIcon::register($this->getIcons());

        // Handle Stubs
        // if (app()->runningInConsole()) {
        //     foreach (app(Filesystem::class)->files(__DIR__ . '/../stubs/') as $file) {
        //         $this->publishes([
        //             $file->getRealPath() => base_path("stubs/filament-dupr-social-login/{$file->getFilename()}"),
        //         ], 'filament-dupr-social-login-stubs');
        //     }
        // }

        // Testing
        // Testable::mixin(new TestsFilamentDuprSocialLogin);
    }

    protected function getAssetPackageName(): ?string
    {
        return 'infoesportes/filament-dupr-social-login';
    }

    /**
     * @return array<Asset>
     */
    protected function getAssets(): array
    {
        return [
            // AlpineComponent::make('filament-dupr-social-login', __DIR__ . '/../resources/dist/components/filament-dupr-social-login.js'),
            Css::make('filament-dupr-social-login-styles', __DIR__ . '/../resources/dist/filament-dupr-social-login.css'),
            // Js::make('filament-dupr-social-login-scripts', __DIR__ . '/../resources/dist/filament-dupr-social-login.js'),
        ];
    }

    /**
     * @return array<class-string>
     */
    protected function getCommands(): array
    {
        return [
            // FilamentDuprSocialLoginCommand::class,
        ];
    }

    /**
     * @return array<string>
     */
    protected function getIcons(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getRoutes(): array
    {
        return [];
    }

    /**
     * @return array<string, mixed>
     */
    protected function getScriptData(): array
    {
        return [];
    }

    /**
     * @return array<string>
     */
    protected function getMigrations(): array
    {
        return [
            // 'create_filament-dupr-social-login_table',
        ];
    }
}

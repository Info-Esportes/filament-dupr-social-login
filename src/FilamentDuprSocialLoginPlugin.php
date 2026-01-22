<?php

namespace InfoEsportes\FilamentDuprSocialLogin;

use Filament\Contracts\Plugin;
use Filament\Panel;
use InfoEsportes\FilamentDuprSocialLogin\Middlewares\DUPRSocialLoginMiddleware;

/**
 * @property-read string|null $clientID The DUPR Client ID
 * @property-read string|null $clientKey The DUPR Client Key
 * @property-read string|null $clientSecret The DUPR Client Secret
 * @property-read bool $production Whether to use the production environment
 */
class FilamentDuprSocialLoginPlugin implements Plugin
{
    /**
     * This is the base slug for the plugin's routes
     *
     * All routes will be prefixed with this slug.
     *
     * E.g., if the slug is 'dupr', the verify route will be '/dupr/verify'.
     */
    protected string $slug = 'dupr';

    public function __construct(
        protected readonly ?string $clientKey = null,
        protected readonly ?string $clientSecret = null,
        protected readonly bool $production = false,
    ) {}

    public static function make(string $clientKey, string $clientSecret): static
    {
        return app(static::class, [
            'clientKey' => $clientKey,
            'clientSecret' => $clientSecret,
        ]);
    }

    public static function get(): static
    {
        /** @var static $plugin */
        $plugin = filament(app(static::class)->getId());

        return $plugin;
    }

    public function getId(): string
    {
        return 'filament-dupr-social-login';
    }

    public function register(Panel $panel): void
    {
        $panel
            ->middleware([
                DUPRSocialLoginMiddleware::class,
            ]);
    }

    public function boot(Panel $panel): void
    {
        //
    }

    // region Methods

    // endregion

    // region Getters & Setters
    public function slug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getClientKey(): ?string
    {
        return $this->clientKey;
    }

    public function getClientSecret(): ?string
    {
        return $this->clientSecret;
    }

    public function isProduction(): bool
    {
        return $this->production;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }
    // endregion
}

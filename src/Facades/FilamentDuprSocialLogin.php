<?php

namespace InfoEsportes\FilamentDuprSocialLogin\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \InfoEsportes\FilamentDuprSocialLogin\FilamentDuprSocialLogin
 */
class FilamentDuprSocialLogin extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \InfoEsportes\FilamentDuprSocialLogin\FilamentDuprSocialLogin::class;
    }
}

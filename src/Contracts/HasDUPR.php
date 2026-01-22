<?php

namespace InfoEsportes\FilamentDuprSocialLogin\Contracts;

interface HasDUPR
{
    /**
     * Get the DUPR ID associated with the user.
     */
    public function getDuprId(): ?string;

    /**
     * Get the DUPR user token associated with the user.
     *
     * This token is used for authenticating API requests to DUPR on behalf of the user.
     */
    public function getDuprUserToken(): ?string;

    /**
     * Get the DUPR refresh token associated with the user.
     *
     * This token is used to refresh the user token when it expires.
     */
    public function getDuprRefreshToken(): ?string;

    /**
     * Set the DUPR ID for the user.
     */
    public function setDuprId(?string $duprId): void;

    /**
     * Set the DUPR user token for the user.
     */
    public function setDuprUserToken(?string $token): void;

    /**
     * Set the DUPR refresh token for the user.
     */
    public function setDuprRefreshToken(?string $token): void;
}

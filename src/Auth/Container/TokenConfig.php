<?php

declare(strict_types=1);

namespace Auth\Container;

class TokenConfig
{
    private $secret;
    private $expiration;
    private $issuer;

    public function __construct(string $secret, int $expiration, string $issuer)
    {
        $this->secret = $secret;
        $this->expiration = $expiration;
        $this->issuer = $issuer;
    }

    public function secret(): string
    {
        return $this->secret;
    }

    public function expiration(): int
    {
        return $this->expiration;
    }

    public function issuer(): string
    {
        return $this->issuer;
    }
}

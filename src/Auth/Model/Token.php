<?php

declare(strict_types=1);

namespace Auth\Model;

class Token
{
    private $token;

    private function __construct(string $token)
    {
        $this->token = $token;
    }

    public static function fromString(string $getToken): self
    {
        return new self($getToken);
    }

    public function __toString(): string
    {
        return $this->token;
    }
}

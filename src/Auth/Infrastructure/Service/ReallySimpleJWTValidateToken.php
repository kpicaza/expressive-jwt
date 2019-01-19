<?php

declare(strict_types=1);

namespace Auth\Infrastructure\Service;

use Auth\Container\TokenConfig;
use Auth\Model\Payload;
use Auth\Model\Token;
use Auth\Service\ValidateToken;
use ReallySimpleJWT\Token as Jwt;

class ReallySimpleJWTValidateToken implements ValidateToken
{
    private $secret;

    public function __construct(TokenConfig $config)
    {
        $this->secret = $config->secret();
    }

    public function __invoke(Token $token): Payload
    {
        Jwt::validate((string)$token, $this->secret);

        return Payload::fromJsonString(
            Jwt::getPayload((string)$token)
        );
    }
}

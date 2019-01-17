<?php

declare(strict_types=1);

namespace Auth\Infrastructure\Service;

use Auth\Container\TokenConfig;
use Auth\Model\Identifier;
use Auth\Model\Token;
use Auth\Service\CreateToken;
use DateTime;
use ReallySimpleJWT\Token as Jwt;

class ReallySimpleJWTCreateToken implements CreateToken
{
    private $secret;
    private $expiration;
    private $issuer;

    public function __construct(TokenConfig $config)
    {
        $this->secret = $config->secret();
        $this->expiration = $config->expiration();
        $this->issuer = $config->issuer();
    }

    public function __invoke(Identifier $identifier): Token
    {
        $expiryDate = new DateTime(\sprintf('+%d second', $this->expiration));

        return Token::fromString(Jwt::getToken(
            (string)$identifier,
            $this->secret,
            $expiryDate->format('Y-m-d H:i:s'),
            $this->issuer
        ));
    }
}

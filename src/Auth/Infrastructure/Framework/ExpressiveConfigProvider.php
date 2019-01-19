<?php

declare(strict_types=1);

namespace Auth\Infrastructure\Framework;

use Auth\Container\ReallySimpleJWTCreateTokenFactory;
use Auth\Container\ReallySimpleJWTValidateTokenFactory;
use Auth\Service\CreateToken;
use Auth\Service\ValidateToken;

class ExpressiveConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                'factories' => [
                    CreateToken::class => ReallySimpleJWTCreateTokenFactory::class,
                    ValidateToken::class => ReallySimpleJWTValidateTokenFactory::class,
                ],
            ],
            'jwt_auth' => [
                'secret' => '0Super@#Secret$$String!!',
                'expiration' => 3600,
                'issuer' => 'Dev Lab App'
            ],
        ];
    }
}

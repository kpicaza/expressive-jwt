<?php

declare(strict_types=1);

namespace Auth\Container;

use Auth\Infrastructure\Service\ReallySimpleJWTValidateToken;
use Auth\Service\ValidateToken;
use Interop\Config\ConfigurationTrait;
use Interop\Config\RequiresConfig;
use Psr\Container\ContainerInterface;

class ReallySimpleJWTValidateTokenFactory implements RequiresConfig
{
    use ConfigurationTrait;

    public function __invoke(ContainerInterface $container): ValidateToken
    {
        $config = $container->get('config')['jwt_auth'];

        return new ReallySimpleJWTValidateToken(
            new TokenConfig(
                $config['secret'],
                $config['expiration'],
                $config['issuer']
            )
        );
    }

    /**
     * @inheritdoc \Interop\Config\RequiresConfig::dimensions
     */
    public function dimensions(): iterable
    {
        return ['jwt_auth'];
    }
}

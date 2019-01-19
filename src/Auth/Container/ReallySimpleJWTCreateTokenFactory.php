<?php

declare(strict_types=1);

namespace Auth\Container;

use Auth\Infrastructure\Service\ReallySimpleJWTCreateToken;
use Auth\Service\CreateToken;
use Interop\Config\ConfigurationTrait;
use Interop\Config\RequiresConfig;
use Psr\Container\ContainerInterface;

class ReallySimpleJWTCreateTokenFactory implements RequiresConfig
{
    use ConfigurationTrait;

    public function __invoke(ContainerInterface $container): CreateToken
    {
        $config = $container->get('config')['jwt_auth'];

        return new ReallySimpleJWTCreateToken(
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
        return ['auth'];
    }
}

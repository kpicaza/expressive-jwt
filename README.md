# Zend Expressive JWT Auth component
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/kpicaza/expressive-jwt/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/kpicaza/expressive-jwt/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/kpicaza/expressive-jwt/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/kpicaza/expressive-jwt/?branch=master)
[![Build Status](https://scrutinizer-ci.com/g/kpicaza/expressive-jwt/badges/build.png?b=master)](https://scrutinizer-ci.com/g/kpicaza/expressive-jwt/build-status/master)
[![Code Intelligence Status](https://scrutinizer-ci.com/g/kpicaza/expressive-jwt/badges/code-intelligence.svg?b=master)](https://scrutinizer-ci.com/code-intelligence)

Easy to use JWT generator/validator utility out of the box for zend expressive.

## Install
````
composer require kpicaza/expressive-jwt-auth
````

## Config

```php
<?php

// config/config.php
...
use Auth\Infrastructure\Framework\ExpressiveConfigProvider;

...

$aggregator = new ConfigAggregator([
    ...
    ExpressiveConfigProvider::class,
    ...

```

```php
<?php

// config/autoload/jwt-auth.global.php

return [
    'jwt_auth' => [
        'secret' => '0Super@#Secret$$String!!',
        'expiration' => 3600,
        'issuer' => 'Dev Lab App'
    ],
]
```

## Usage

Create token from request handler

```php
<?php

declare(strict_types=1);

use Auth\Model\Identifier;
use Auth\Service\CreateToken;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Zend\Diactoros\Response\JsonResponse;

class CreateTokenHandler implements RequestHandlerInterface
{
    /** @var CreateToken  */
    private $createToken;
    
    public function __construct(CreateToken $createToken) 
    {
        $this->createToken = $createToken;
    }
    
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $createTokenService = $this->createToken;
        
        $identifier = Identifier::fromString('SomeUserId');

        /** @var \Auth\Model\Token $token */
        $token = $createTokenService($identifier);
        
        return new JsonResponse([
            'token_type' => 'Bearer',
            'access_token' => (string)$token,
        ]);
    }
}

```

Create Request Handler Factory

```php
<?php

declare(strict_types=1);

use App\Handler\CreateTokenHandler;
use Auth\Service\CreateToken;
use Psr\Container\ContainerInterface;

class CreateTokenHandlerFactory
{
    public function __invoke(ContainerInterface $container): CreateTokenHandler
    {
        return new CreateTokenHandler(
            $container->get(CreateToken::class)
        );       
    }
}

```

Update config

```php
<?php
...
use App\Handler\CreateTokenHandler;
use App\Container\CreateTokenHandlerFactory;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                'factories' => [
                    CreateTokenHandler::class => CreateTokenHandlerFactory::class,
                ],
            ],
        ];
    }
}
```

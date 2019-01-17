<?php

declare(strict_types=1);

namespace Auth\Service;

use Auth\Model\Identifier;
use Auth\Model\Token;

interface CreateToken
{
    public function __invoke(Identifier $identifier): Token;
}

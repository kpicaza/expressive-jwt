<?php

declare(strict_types=1);

namespace Auth\Service;

use Auth\Model\Payload;
use Auth\Model\Token;

interface ValidateToken
{
    public function __invoke(Token $token): Payload;
}

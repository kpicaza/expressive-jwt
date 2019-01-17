<?php

declare(strict_types=1);

namespace Auth\Model;

use JsonSerializable;

class Payload implements JsonSerializable
{
    private $data;

    private function __construct(array $payload)
    {
        $this->data = $payload;
    }

    public static function fromJsonString(string $getPayload): self
    {
        return new self(\json_decode($getPayload, true));
    }

    public function jsonSerialize(): array
    {
        return $this->data;
    }
}

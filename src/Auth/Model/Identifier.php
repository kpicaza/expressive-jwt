<?php

declare(strict_types=1);

namespace Auth\Model;

class Identifier
{
    private $identifier;

    private function __construct(string $id)
    {
        $this->identifier = $id;
    }

    public static function fromString(string $id): self
    {
        return new self($id);
    }

    public function __toString(): string
    {
        return $this->identifier;
    }
}

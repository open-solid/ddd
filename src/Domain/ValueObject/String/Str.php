<?php

declare(strict_types=1);

namespace OpenSolid\Ddd\Domain\ValueObject\String;

use Symfony\Component\String\UnicodeString;

class Str extends UnicodeString
{
    public static function from(string $value): static
    {
        return new static($value);
    }

    public function value(): string
    {
        return $this->string;
    }

    final public function __construct(string $value = '')
    {
        parent::__construct($value);
    }
}

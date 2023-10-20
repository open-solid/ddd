<?php

namespace Ddd\ValueObject\String;

use Symfony\Component\String\UnicodeString;

class Str extends UnicodeString
{
    public static function from(string $value): self
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

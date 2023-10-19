<?php

namespace Ddd\ValueObject\Integer;

use Ddd\Error\InvalidArgumentError;

readonly class PositiveInteger extends Integer
{
    public static function from(int $value): self
    {
        if ($value < 0) {
            throw new InvalidArgumentError('Value must be positive.');
        }

        return new static($value);
    }
}

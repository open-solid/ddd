<?php

declare(strict_types=1);

namespace Ddd\ValueObject\Integer;

use Ddd\Error\InvalidArgumentError;

readonly class PositiveInteger extends Integer
{
    public static function from(int $value): self
    {
        if ($value < 0) {
            throw InvalidArgumentError::create('Value must be positive.');
        }

        return new static($value);
    }
}

<?php

declare(strict_types=1);

namespace Ddd\Domain\ValueObject\Integer;

use Ddd\Domain\Error\InvalidArgumentError;

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

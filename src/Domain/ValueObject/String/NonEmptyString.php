<?php

declare(strict_types=1);

namespace Ddd\Domain\ValueObject\String;

use Ddd\Domain\Error\InvalidArgumentError;

class NonEmptyString extends Str
{
    /** @var string */
    protected const DEFAULT_ERROR_MESSAGE = 'String cannot be empty.';

    public static function from(string $value): self
    {
        $str = (new static($value))->trim();

        if ($str->isEmpty()) {
            throw InvalidArgumentError::create(self::DEFAULT_ERROR_MESSAGE);
        }

        return $str;
    }
}

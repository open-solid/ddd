<?php

namespace Ddd\ValueObject\Uid;

use Ddd\Error\InvalidArgumentError;
use Symfony\Component\Uid\Uuid as SymfonyUuid;

/**
 * @example 1C4Gx3HwRKMqqm8pYTjiXg
 */
readonly class UuidBase58 extends Uuid
{
    public static function create(): static
    {
        return new static(SymfonyUuid::v7()->toBase58());
    }

    public static function fromString(string $value): static
    {
        try {
            return new static(SymfonyUuid::fromString($value)->toBase58());
        } catch (\InvalidArgumentException $e) {
            throw new InvalidArgumentError($e->getMessage(), $e->getCode(), $e);
        }
    }
}

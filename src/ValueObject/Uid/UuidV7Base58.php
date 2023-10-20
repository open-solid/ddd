<?php

namespace Ddd\ValueObject\Uid;

use Ddd\Error\InvalidArgumentError;
use Symfony\Component\Uid\Uuid as SymfonyUuid;

/**
 * @example 1C4Gx3HwRKMqqm8pYTjiXg
 */
readonly class UuidV7Base58 extends Uuid
{
    public static function create(): static
    {
        return new static(self::generate());
    }

    public static function fromString(string $value): static
    {
        try {
            return new static(SymfonyUuid::fromString($value)->toBase58());
        } catch (\InvalidArgumentException $e) {
            throw InvalidArgumentError::create($e->getMessage(), $e->getCode(), $e);
        }
    }

    public static function generate(): string
    {
        return SymfonyUuid::v7()->toBase58();
    }
}

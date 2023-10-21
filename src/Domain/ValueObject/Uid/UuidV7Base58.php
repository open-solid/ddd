<?php

declare(strict_types=1);

namespace Ddd\Domain\ValueObject\Uid;

use Ddd\Domain\Error\InvalidArgument;
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

    public static function from(string $value): static
    {
        try {
            return new static(SymfonyUuid::fromString($value)->toBase58());
        } catch (\InvalidArgumentException $e) {
            throw InvalidArgument::create($e->getMessage(), $e->getCode(), $e);
        }
    }

    public static function generate(): string
    {
        return SymfonyUuid::v7()->toBase58();
    }
}

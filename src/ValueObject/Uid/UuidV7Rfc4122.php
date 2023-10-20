<?php

declare(strict_types=1);

namespace Ddd\ValueObject\Uid;

use Ddd\Error\InvalidArgumentError;
use Symfony\Component\Uid\Uuid as SymfonyUuid;

/**
 * @see https://tools.ietf.org/html/rfc4122
 * @example f81d4fae-7dec-11d0-a765-00a0c91e6bf6
 */
readonly class UuidV7Rfc4122 extends Uuid
{
    public static function create(): static
    {
        return new static(self::generate());
    }

    public static function fromString(string $value): static
    {
        try {
            return new static(SymfonyUuid::fromString($value)->toRfc4122());
        } catch (\InvalidArgumentException $e) {
            throw InvalidArgumentError::create($e->getMessage(), $e->getCode(), $e);
        }
    }

    public static function generate(): string
    {
        return SymfonyUuid::v7()->toRfc4122();
    }
}

<?php

declare(strict_types=1);

namespace Ddd\Domain\ValueObject\Uid;

readonly abstract class Uuid implements \Stringable
{
    abstract public static function create(): static;

    abstract public static function from(string $value): static;

    abstract public static function generate(): string;

    public function value(): string
    {
        return $this->value;
    }

    public function equals(self $other): bool
    {
        return $this->value() === $other->value();
    }

    public function __toString(): string
    {
        return $this->value();
    }

    final protected function __construct(private string $value)
    {
    }
}

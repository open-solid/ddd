<?php

namespace Ddd\ValueObject\String;

readonly abstract class StringValueObject implements \Stringable
{
    public static function from(string $value): self
    {
        return new static($value);
    }

    public function value(): string
    {
        return $this->value;
    }

    public function length(): int
    {
        return strlen($this->value());
    }

    public function isEmpty(): bool
    {
        return '' === $this->value();
    }

    public function trim(string $characters = " \t\n\r\0\x0B"): self
    {
        return new static(trim($this->value(), $characters));
    }

    public function equals(self $other): bool
    {
        return $this->value() === $other->value();
    }

    public function toLower(): self
    {
        return new static(strtolower($this->value()));
    }

    public function toUpper(): self
    {
        return new static(strtoupper($this->value()));
    }

    public function toTitle(): self
    {
        return new static(ucwords($this->value()));
    }

    public function toString(): string
    {
        return $this->value();
    }

    public function __toString(): string
    {
        return $this->value();
    }

    final protected function __construct(private string $value)
    {
    }
}

<?php

declare(strict_types=1);

namespace Ddd\Error;

class DomainError extends \DomainException
{
    /** @var string */
    protected const DEFAULT_MESSAGE = 'A domain error occurred.';

    private array $exceptions = [];

    /**
     * @param array<self> $exceptions
     */
    public static function createMany(array $exceptions): static
    {
        $messages = array_map(static fn (self $exception) => $exception->getMessage(), $exceptions);
        $messages = implode("\n", $messages);

        $self = static::create($messages);
        $self->exceptions = $exceptions;

        return $self;
    }

    /**
     * @return static
     */
    public static function create(string $message = null, int $code = 0, \Throwable $previous = null): self
    {
        return new static($message ?? static::DEFAULT_MESSAGE, $code, $previous);
    }

    /**
     * @return array<self>
     */
    public function getExceptions(): array
    {
        return $this->exceptions;
    }

    final private function __construct(string $message, int $code, ?\Throwable $previous)
    {
        parent::__construct($message, $code, $previous);
    }
}

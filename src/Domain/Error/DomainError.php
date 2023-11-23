<?php

declare(strict_types=1);

namespace OpenSolid\Ddd\Domain\Error;

class DomainError extends \DomainException
{
    /** @var string */
    protected const DEFAULT_MESSAGE = 'A domain error occurred.';

    private array $errors = [];

    /**
     * @param array<self> $errors
     */
    public static function createMany(array $errors): static
    {
        $messages = array_map(static fn (self $error) => $error->getMessage(), $errors);
        $messages = implode("\n", $messages);

        $self = static::create($messages);
        $self->errors = $errors;

        return $self;
    }

    public static function create(string $message = null, int $code = 0, \Throwable $previous = null): static
    {
        return new static($message ?? static::DEFAULT_MESSAGE, $code, $previous);
    }

    /**
     * @return array<self>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    final protected function __construct(string $message, int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}

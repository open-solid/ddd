<?php

declare(strict_types=1);

namespace Ddd\Domain\Error;

class InvalidArgumentError extends DomainError
{
    protected const DEFAULT_MESSAGE = 'Invalid argument value.';
}

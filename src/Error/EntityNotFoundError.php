<?php

declare(strict_types=1);

namespace Ddd\Error;

class EntityNotFoundError extends DomainError
{
    protected const DEFAULT_MESSAGE = 'Entity not found.';
}

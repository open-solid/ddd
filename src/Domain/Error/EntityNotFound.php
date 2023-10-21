<?php

declare(strict_types=1);

namespace Ddd\Domain\Error;

class EntityNotFound extends DomainError
{
    protected const DEFAULT_MESSAGE = 'Entity not found.';
}

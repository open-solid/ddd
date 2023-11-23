<?php

declare(strict_types=1);

namespace OpenSolid\Ddd\Domain\Error;

class InvalidArgument extends DomainError
{
    protected const DEFAULT_MESSAGE = 'Invalid argument value.';
}

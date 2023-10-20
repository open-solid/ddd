<?php

namespace Ddd\Error;

class InvalidArgumentError extends DomainError
{
    protected const DEFAULT_MESSAGE = 'Invalid argument value.';
}

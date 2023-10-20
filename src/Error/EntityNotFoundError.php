<?php

namespace Ddd\Error;

class EntityNotFoundError extends DomainError
{
    protected const DEFAULT_MESSAGE = 'Entity not found.';
}

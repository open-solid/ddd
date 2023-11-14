<?php

declare(strict_types=1);

namespace Tests\Ddd\Domain\Entity;

use Ddd\Domain\Event\DomainEvent;

/**
 * @psalm-immutable
 */
readonly class EntityUpdated extends DomainEvent
{
}

<?php

declare(strict_types=1);

namespace Ddd\Tests\Domain\Entity;

use Ddd\Domain\Event\DomainEvent;

/**
 * @psalm-immutable
 */
readonly class EntityUpdated extends DomainEvent
{
}

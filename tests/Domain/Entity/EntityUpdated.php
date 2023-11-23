<?php

declare(strict_types=1);

namespace OpenSolid\Tests\Ddd\Domain\Entity;

use OpenSolid\Ddd\Domain\Event\DomainEvent;

/**
 * @psalm-immutable
 */
readonly class EntityUpdated extends DomainEvent
{
}

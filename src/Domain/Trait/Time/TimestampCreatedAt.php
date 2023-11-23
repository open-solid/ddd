<?php

namespace OpenSolid\Ddd\Domain\Trait\Time;

use DateTimeImmutable;

trait TimestampCreatedAt
{
    private readonly DateTimeImmutable $createdAt;

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }
}

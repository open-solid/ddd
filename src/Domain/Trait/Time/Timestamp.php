<?php

namespace OpenSolid\Ddd\Domain\Trait\Time;

use DateTimeImmutable;

trait Timestamp
{
    private readonly DateTimeImmutable $createdAt;
    private ?DateTimeImmutable $updatedAt = null;

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }
}

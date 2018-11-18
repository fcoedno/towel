<?php

declare(strict_types=1);

namespace Towel\Domain\Model\Person;

class PersonId
{
    private $id;

    public function __construct(int $id)
    {
        $this->id = $id;
    }

    public function value(): int
    {
        return $this->id;
    }
}
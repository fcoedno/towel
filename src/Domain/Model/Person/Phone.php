<?php

declare(strict_types=1);

namespace Towel\Domain\Model\Person;

class Phone
{
    /**
     * @var string
     */
    private $phone;

    public function __construct(string $phone)
    {
        $this->phone = $phone;
    }

    public function __toString(): string
    {
        return $this->phone;
    }
}
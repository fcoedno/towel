<?php

declare(strict_types=1);

namespace Towel\Domain\Model\Person;

class Person
{
    private $id;
    private $name;
    private $phones;

    public function __construct(PersonId $id, PersonName $name, array $phones = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->phones = $phones;
    }

    /**
     * @return PersonId
     */
    public function getId(): PersonId
    {
        return $this->id;
    }
}
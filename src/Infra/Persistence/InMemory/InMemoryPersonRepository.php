<?php

declare(strict_types=1);

namespace Towel\Infra\Persistence\InMemory;

use Towel\Domain\Model\Person\Person;
use Towel\Domain\Model\Person\PersonId;
use Towel\Domain\Model\Person\PersonNotFoundException;
use Towel\Domain\Model\Person\PersonRepository;

class InMemoryPersonRepository implements PersonRepository
{
    /**
     * @var array
     */
    private $people = [];

    public function add(Person $person)
    {
        $this->people[$person->getId()->value()] = $person;
    }

    public function find(PersonId $id): Person
    {
        $person = $this->people[$id->value()] ?? null;
        if (is_null($person)) {
            throw new PersonNotFoundException();
        }
        return $person;
    }
}
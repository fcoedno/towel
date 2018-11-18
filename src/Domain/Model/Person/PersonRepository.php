<?php

declare(strict_types=1);

namespace Towel\Domain\Model\Person;

interface PersonRepository
{
    /**
     * Adds a person
     * @param Person $person
     */
    public function add(Person $person);

    /**
     * Finds a person by its id
     * @param PersonId $id
     * @return Person
     * @throws PersonNotFoundException
     */
    public function find(PersonId $id): Person;
}
<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 14:14
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Person;
use AppBundle\Repository\Contract\PersonRepository;
use AppBundle\Repository\Exception\PersonNotFoundException;

class InMemoryPersonRepository implements PersonRepository
{
    private $people = [];

    /**
     * @inheritdoc
     */
    public function save(Person $person)
    {
        $this->people[$person->getId()] = $person;
    }

    /**
     * @inheritdoc
     */
    public function find(int $id): Person
    {
        if (isset($this->people[$id])) {
            return $this->people[$id];
        }

        throw new PersonNotFoundException();
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 14:14
 */

namespace AppBundle\Tests\Mock;

use AppBundle\Entity\Person;
use AppBundle\Repository\Contract\PersonRepository;
use AppBundle\Repository\Exception\PersonNotFoundException;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;

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

    /**
     * @inheritDoc
     */
    public function findAll(): Collection
    {
        return new ArrayCollection($this->people);
    }
}
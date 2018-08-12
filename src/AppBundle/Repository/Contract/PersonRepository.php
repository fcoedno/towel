<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 14:11
 */

namespace AppBundle\Repository\Contract;


use AppBundle\Entity\Person;
use AppBundle\Repository\Exception\PersonNotFoundException;

interface PersonRepository
{
    /**
     * Inserts or updates a person
     *
     * @param Person $person
     */
    public function save(Person $person);

    /**
     * Retrieves a person
     *
     * @param $id
     * @return Person
     *
     * @throws PersonNotFoundException In case the person was not found
     */
    public function find(int $id): Person;
}
<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 20:52
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Person;
use AppBundle\Repository\Contract\PersonRepository;
use AppBundle\Repository\Exception\PersonNotFoundException;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class DoctrinePersonRepository implements PersonRepository
{
    /**
     * @var EntityManager
     */
    private $em;

    /**
     * @var EntityRepository
     */
    private $repository;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
        $this->repository = $em->getRepository(Person::class);
    }

    /**
     * @inheritDoc
     */
    public function save(Person $person)
    {
        $this->em->persist($person);
        $this->em->flush();
    }

    /**
     * @inheritDoc
     */
    public function find(int $id): Person
    {
        $person = $this->repository->find($id);

        if (is_null($person)) {
            throw new PersonNotFoundException();
        }

        return $person;
    }

    /**
     * @inheritDoc
     */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }
}
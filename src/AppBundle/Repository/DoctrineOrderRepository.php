<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 21:04
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Order;
use AppBundle\Repository\Contract\OrderRepository;
use AppBundle\Repository\Exception\OrderNotFoundException;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

class DoctrineOrderRepository implements OrderRepository
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
        $this->repository = $em->getRepository(Order::class);
    }

    /**
     * @inheritDoc
     */
    public function save(Order $order)
    {
        $this->em->persist($order);
        $this->em->flush();
    }

    /**
     * @inheritDoc
     */
    public function find(int $id): Order
    {
        $order = $this->repository->find($id);
        if (is_null($order)) {
            throw new OrderNotFoundException();
        }
        return $order;
    }

    /**
     * @inheritDoc
     */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }
}
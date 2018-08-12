<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 16:34
 */

namespace AppBundle\Tests\Mock;


use AppBundle\Entity\Order;
use AppBundle\Repository\Contract\OrderRepository;
use AppBundle\Repository\Exception\OrderNotFoundException;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class InMemoryOrderRepository implements OrderRepository
{
    /**
     * @var array|Order[]
     */
    private $orders;

    /**
     * @inheritDoc
     */
    public function save(Order $order)
    {
        $this->orders[$order->getId()] = $order;
    }

    /**
     * @inheritDoc
     */
    public function find(int $id): Order
    {
        if (isset($this->orders[$id])) {
            return $this->orders[$id];
        }

        throw new OrderNotFoundException();
    }

    /**
     * @inheritDoc
     */
    public function findAll(): Collection
    {
        return new ArrayCollection($this->orders);
    }
}
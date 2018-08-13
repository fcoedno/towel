<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 16:27
 */

namespace AppBundle\Repository\Contract;


use AppBundle\Entity\Order;
use AppBundle\Repository\Exception\OrderNotFoundException;
use Doctrine\Common\Collections\Collection;

interface OrderRepository
{
    /**
     * Inserts or updates an order
     * @param Order $order
     */
    public function save(Order $order);

    /**
     * Retrieves an order
     *
     * @param int $id
     * @return Order
     *
     * @throws OrderNotFoundException If the order does not exist
     */
    public function find(int $id): Order;

    /**
     * Returns all orders
     *
     * @return array|Order[]
     */
    public function findAll(): array;
}
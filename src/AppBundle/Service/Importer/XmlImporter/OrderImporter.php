<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 16:41
 */

namespace AppBundle\Service\Importer\XmlImporter;


use AppBundle\Entity\Order;
use AppBundle\Entity\Person;
use AppBundle\Entity\ShippingAddress;
use AppBundle\Repository\Contract\OrderRepository;
use AppBundle\Service\Importer\XmlImporter;

class OrderImporter extends XmlImporter
{
    /**
     * @var OrderRepository
     */
    private $repository;

    public function __construct(OrderRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    public function import(string $source)
    {
        $person = new Person(1, 'Name 1');
        $addr = new ShippingAddress();
        $this->repository->save(new Order(1, $person, $addr));
    }
}
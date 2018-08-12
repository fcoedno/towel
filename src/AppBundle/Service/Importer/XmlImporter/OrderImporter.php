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
use AppBundle\Repository\Contract\PersonRepository;
use AppBundle\Service\Extractor\Dto\ShipOrder;
use AppBundle\Service\Extractor\Extractor;
use AppBundle\Service\Importer\XmlImporter;

class OrderImporter extends XmlImporter
{
    /**
     * @var OrderRepository
     */
    private $orderRepository;
    /**
     * @var Extractor
     */
    private $extractor;
    /**
     * @var PersonRepository
     */
    private $personRepository;

    public function __construct(
        Extractor $extractor,
        PersonRepository $personRepository,
        OrderRepository $orderRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->extractor = $extractor;
        $this->personRepository = $personRepository;
    }

    /**
     * @inheritDoc
     */
    public function import(string $source)
    {
        $shipOrders = $this->extractor->extractShipOrders($source);
        array_walk($shipOrders, [$this, 'importOrder']);
    }

    /**
     * @param ShipOrder $shipOrder
     */
    private function importOrder(ShipOrder $shipOrder)
    {
        $person = new Person(1, 'Name 1');
        $addr = new ShippingAddress();
        $order = new Order(1, $person, $addr);
        $this->orderRepository->save($order);
    }
}
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
use AppBundle\Repository\Exception\OrderNotFoundException;
use AppBundle\Service\Extractor\Dto\Item;
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
        if ('shiporders' === simplexml_load_string($source)->getName()) {
            $shipOrders = $this->extractor->extractShipOrders($source);
            array_walk($shipOrders, [$this, 'importOrder']);
            return;
        }

        parent::import($source);
    }

    /**
     * @param ShipOrder $shipOrder
     */
    private function importOrder(ShipOrder $shipOrder)
    {
        $order = $this->getOrder($shipOrder->getOrderid());
        $person = $this->personRepository->find($shipOrder->getOrderperson());
        $order->setPerson($person);
        $address = $order->getShippingAddress() ?? new ShippingAddress();

        $address->setName($shipOrder->getShipto()->getName());
        $address->setAddress($shipOrder->getShipto()->getAddress());
        $address->setCity($shipOrder->getShipto()->getCity());
        $address->setCountry($shipOrder->getShipto()->getCountry());

        $order->setShippingAddress($address);

        /** @var Item $item */
        $order->getItems()->clear();
        foreach ($shipOrder->getItems() as $item) {
            $order->addItem(
                $item->getTitle(),
                $item->getNote(),
                $item->getQuantity(),
                $item->getPrice()
            );
        }

        $this->orderRepository->save($order);
    }

    private function getOrder($id)
    {
        try {
            return $this->orderRepository->find($id);
        } catch (OrderNotFoundException $exception) {
            return (new Order())->setId($id);
        }
    }
}
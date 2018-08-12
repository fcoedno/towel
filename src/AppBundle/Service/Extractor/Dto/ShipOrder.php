<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 16:55
 */

namespace AppBundle\Service\Extractor\Dto;


use JMS\Serializer\Annotation as Serializer;

class ShipOrder
{
    /**
     * @var integer
     * @Serializer\Type(name="integer")
     */
    private $orderid;
    /**
     * @var integer
     * @Serializer\Type(name="integer")
     */
    private $orderperson;
    /**
     * @var ShipTo
     * @Serializer\Type("AppBundle\Service\Extractor\Dto\ShipTo")
     */
    private $shipto;
    /**
     * @var array
     * @Serializer\Type("array<AppBundle\Service\Extractor\Dto\Item>")
     * @Serializer\XmlList(entry="item")
     */
    private $items = [];

    /**
     * @return mixed
     */
    public function getOrderid()
    {
        return $this->orderid;
    }

    /**
     * @param mixed $orderid
     * @return ShipOrder
     */
    public function setOrderid($orderid)
    {
        $this->orderid = $orderid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOrderperson()
    {
        return $this->orderperson;
    }

    /**
     * @param mixed $orderperson
     * @return ShipOrder
     */
    public function setOrderperson($orderperson)
    {
        $this->orderperson = $orderperson;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getShipto()
    {
        return $this->shipto;
    }

    /**
     * @param mixed $shipto
     * @return ShipOrder
     */
    public function setShipto($shipto)
    {
        $this->shipto = $shipto;
        return $this;
    }

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param array $items
     * @return ShipOrder
     */
    public function setItems($items): ShipOrder
    {
        $this->items = $items;
        return $this;
    }
}
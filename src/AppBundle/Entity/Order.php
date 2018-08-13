<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Order
 *
 * @ORM\Table(name="`order`", indexes={@ORM\Index(name="order_person_FK", columns={"person_id"}), @ORM\Index(name="order_shipping_address_FK", columns={"shipping_address_id"})})
 * @ORM\Entity
 */
class Order
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Person
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Person")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="person_id", referencedColumnName="id")
     * })
     */
    private $person;

    /**
     * @var \AppBundle\Entity\ShippingAddress
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\ShippingAddress", cascade={"persist"})
     * @ORM\JoinColumn(name="shipping_address_id", referencedColumnName="id")
     */
    private $shippingAddress;

    /**
     * @var Collection|OrderItem[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\OrderItem", mappedBy="order", cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $items;

    /**
     * Order constructor.
     */
    public function __construct()
    {
        $this->items = new ArrayCollection();
    }

    /**
     * @param int $id
     * @return Order
     */
    public function setId(int $id): Order
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param Person $person
     * @return Order
     */
    public function setPerson(Person $person): Order
    {
        $this->person = $person;
        return $this;
    }

    /**
     * @param ShippingAddress $shippingAddress
     * @return Order
     */
    public function setShippingAddress(ShippingAddress $shippingAddress): Order
    {
        $this->shippingAddress = $shippingAddress;
        return $this;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Person
     */
    public function getPerson(): Person
    {
        return $this->person;
    }

    /**
     * @return ShippingAddress|null
     */
    public function getShippingAddress(): ?ShippingAddress
    {
        return $this->shippingAddress;
    }

    /**
     * @return OrderItem[]|Collection
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Adds an item to the order
     *
     * @param string $title
     * @param string $note
     * @param int $quantity
     * @param float $price
     */
    public function addItem(
        string $title,
        string $note,
        int $quantity,
        float $price
    ) {
        $item = (new OrderItem())
            ->setTitle($title)
            ->setNote($note)
            ->setQuantity($quantity)
            ->setPrice($price)
            ->setOrder($this)
        ;
        $this->items->add($item);
    }
}


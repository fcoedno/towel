<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Order
 *
 * @ORM\Table(name="order", indexes={@ORM\Index(name="order_person_FK", columns={"person_id"}), @ORM\Index(name="order_shipping_address_FK", columns={"shipping_address_id"})})
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
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\ShippingAddress")
     * @ORM\JoinColumn(name="shipping_address_id", referencedColumnName="id")
     */
    private $shippingAddress;

    /**
     * @var Collection|OrderItem[]
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\OrderItem", mappedBy="order", cascade={"persist", "remove"})
     */
    private $items;

    /**
     * Order constructor.
     *
     * @param int $id
     * @param Person $person
     * @param ShippingAddress $shippingAddress
     */
    public function __construct(int $id, Person $person, ShippingAddress $shippingAddress)
    {
        $this->id = $id;
        $this->person = $person;
        $this->shippingAddress = $shippingAddress;
        $this->items = new ArrayCollection();
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
     * @return ShippingAddress
     */
    public function getShippingAddress(): ShippingAddress
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


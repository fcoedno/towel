<?php

namespace AppBundle\Entity;

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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\ShippingAddress")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="shipping_address_id", referencedColumnName="id")
     * })
     */
    private $shippingAddress;


}


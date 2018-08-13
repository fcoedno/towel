<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShippingAddress
 *
 * @ORM\Table(name="shipping_address")
 * @ORM\Entity
 */
class ShippingAddress
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=100, nullable=false)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=100, nullable=false)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=100, nullable=false)
     */
    private $country;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @param string $name
     * @return ShippingAddress
     */
    public function setName(string $name): ShippingAddress
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @param string $address
     * @return ShippingAddress
     */
    public function setAddress(string $address): ShippingAddress
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @param string $city
     * @return ShippingAddress
     */
    public function setCity(string $city): ShippingAddress
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @param string $country
     * @return ShippingAddress
     */
    public function setCountry(string $country): ShippingAddress
    {
        $this->country = $country;
        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }
}


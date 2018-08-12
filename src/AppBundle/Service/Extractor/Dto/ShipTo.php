<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 16:56
 */

namespace AppBundle\Service\Extractor\Dto;


use JMS\Serializer\Annotation as Serializer;

class ShipTo
{
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $name;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $address;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $city;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $country;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return ShipTo
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     * @return ShipTo
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     * @return ShipTo
     */
    public function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * @param mixed $country
     * @return ShipTo
     */
    public function setCountry($country)
    {
        $this->country = $country;
        return $this;
    }
}
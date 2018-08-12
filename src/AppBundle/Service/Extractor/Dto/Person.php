<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 11/08/18
 * Time: 20:23
 */

namespace AppBundle\Service\Extractor\Dto;


use JMS\Serializer\Annotation as Serializer;

/**
 * DTO For person import
 */
class Person
{
    /**
     * @var integer
     * @Serializer\Type(name="integer")
     */
    private $personid;
    /**
     * @var string
     * @Serializer\Type(name="string")
     */
    private $personname;
    /**
     * @var array $phones
     * @Serializer\Type(name="array<string>")
     * @Serializer\XmlList(entry="phone")
     */
    private $phones = [];

    /**
     * @return mixed
     */
    public function getPersonid()
    {
        return $this->personid;
    }

    /**
     * @param mixed $personid
     * @return Person
     */
    public function setPersonid($personid): Person
    {
        $this->personid = $personid;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPersonname()
    {
        return $this->personname;
    }

    /**
     * @param mixed $personname
     * @return Person
     */
    public function setPersonname($personname)
    {
        $this->personname = $personname;
        return $this;
    }

    /**
     * @return array
     */
    public function getPhones(): array
    {
        return $this->phones;
    }

    /**
     * @param array $phones
     * @return Person
     */
    public function setPhones(array $phones): Person
    {
        $this->phones = $phones;
        return $this;
    }
}
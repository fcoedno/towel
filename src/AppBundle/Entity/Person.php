<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Person
 *
 * @ORM\Table(name="person")
 * @ORM\Entity
 */
class Person
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="bigint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\PersonPhone", mappedBy="person", cascade={"persist", "delete"})
     */
    private $phones;

    public function __construct(int $id, string $name, array $numbers = [])
    {
        $this->id = $id;
        $this->name = $name;
        $this->phones = new ArrayCollection();

        foreach ($numbers as $number) {
            $this->addPhone($number);
        }
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * Add a phone number
     *
     * @param string $number
     * @return $this
     */
    public function addPhone(string $number)
    {
        $phone = new PersonPhone($this, $number);
        $this->phones->add($phone);
        return $this;
    }

    /**
     * @return Collection
     */
    public function getPhones(): Collection
    {
        return $this->phones;
    }
}


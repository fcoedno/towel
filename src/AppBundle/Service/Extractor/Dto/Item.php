<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 16:59
 */

namespace AppBundle\Service\Extractor\Dto;


use JMS\Serializer\Annotation as Serializer;

class Item
{
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $title;
    /**
     * @var string
     * @Serializer\Type("string")
     */
    private $note;
    /**
     * @var integer
     * @Serializer\Type("integer")
     */
    private $quantity;
    /**
     * @var float
     * @Serializer\Type("float")
     */
    private $price;

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     * @return Item
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * @param mixed $note
     * @return Item
     */
    public function setNote($note)
    {
        $this->note = $note;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param mixed $quantity
     * @return Item
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     * @return Item
     */
    public function setPrice($price)
    {
        $this->price = $price;
        return $this;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 17:03
 */

namespace AppBundle\Service\Extractor\Dto;


use JMS\Serializer\Annotation as Serializer;

class ShipOrderCollection
{
    /**
     * @var array|ShipOrder[]
     * @Serializer\Type("array<AppBundle\Service\Extractor\Dto\ShipOrder>")
     * @Serializer\XmlList(inline=true, entry="shiporder")
     */
    private $shiporders;

    /**
     * @return mixed
     */
    public function getShiporders()
    {
        return $this->shiporders;
    }
}
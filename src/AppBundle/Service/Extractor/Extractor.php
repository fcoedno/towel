<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 11/08/18
 * Time: 20:23
 */

namespace AppBundle\Service\Extractor;


use AppBundle\Service\Extractor\Dto\Person;
use AppBundle\Service\Extractor\Dto\PersonCollection;
use AppBundle\Service\Extractor\Dto\ShipOrderCollection;
use JMS\Serializer\SerializerBuilder;

class Extractor
{
    /**
     * Extract people from a xml string
     *
     * @param string $xml
     * @return array|Person[]
     */
    public function extractPeople(string $xml): array
    {
        $serializer = SerializerBuilder::create()->build();
        $collection = $serializer->deserialize($xml, PersonCollection::class, 'xml');
        return $collection->getPeople();
    }

    /**
     * Extract ship orders from a xml string
     *
     * @param string $xml
     * @return array
     */
    public function extractShipOrders(string $xml): array
    {
        $serializer = SerializerBuilder::create()->build();
        $collection = $serializer->deserialize($xml, ShipOrderCollection::class, 'xml');
        return $collection->getShiporders();
    }
}
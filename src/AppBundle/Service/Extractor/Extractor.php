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
}
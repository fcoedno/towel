<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 11/08/18
 * Time: 22:42
 */

namespace AppBundle\Service\Importer\XmlImporter\Dto;


use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\XmlRoot("people")
 */
class PersonCollection
{
    /**
     * @var array|Person[]
     * @Serializer\Type("array<AppBundle\Service\Importer\XmlImporter\Dto\Person>")
     * @Serializer\XmlList(entry="person", inline=true)
     */
    private $people;

    /**
     * @return Person[]|array
     */
    public function getPeople()
    {
        return $this->people;
    }
}
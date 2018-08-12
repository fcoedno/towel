<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 13:46
 */

namespace AppBundle\Service\Importer\XmlImporter;


use AppBundle\Service\Extractor\Extractor;
use AppBundle\Service\Importer\XmlImporter;
use AppBundle\Entity\Person;

class PersonImporter extends XmlImporter
{
    /**
     * @var Extractor
     */
    private $extractor;

    public function __construct(Extractor $extractor)
    {
        $this->extractor = $extractor;
    }

    /**
     * @inheritdoc
     */
    public function import(string $source): array
    {
        $people = $this->extractor->extractPeople($source);
        $data = [];
        foreach ($people as $person) {
            $data[] = new Person($person->getPersonid(), $person->getPersonname(), $person->getPhones());
        }
        return $data;
    }
}
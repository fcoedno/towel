<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 11/08/18
 * Time: 15:03
 */

namespace AppBundle\Service\Importer;


use AppBundle\Entity\Person;
use AppBundle\Service\Importer\XmlImporter\Extractor;

/**
 * Imports data from a xml source string
 */
class XmlImporter implements Importer
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
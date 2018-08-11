<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 11/08/18
 * Time: 20:23
 */

namespace AppBundle\Service\Importer\XmlImporter;


use AppBundle\Service\Importer\XmlImporter\Dto\Person;

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
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 11/08/18
 * Time: 15:03
 */

namespace AppBundle\Service\Importer;

/**
 * Imports data from a xml source string
 */
abstract class XmlImporter implements Importer
{
    /**
     * @var XmlImporter
     */
    private $importer;

    public function setNext(XmlImporter $importer)
    {
        $this->importer = $importer;
    }

    /**
     * Imports from source
     *
     * @param string $source
     * @return array
     */
    public function import(string $source): array
    {
        if (! is_null($this->importer)) {
            return $this->importer->import($source);
        }

        return [];
    }
}
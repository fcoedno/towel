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
class XmlImporter implements Importer
{
    /**
     * @inheritdoc
     */
    public function import(string $source): array
    {
        return [];
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 11/08/18
 * Time: 15:03
 */

namespace AppBundle\Service\Importer;


use AppBundle\Entity\Person;

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
        return [new Person(1, 'Name 1'), new Person(2, 'Name 2'), new Person(3, 'Name 3')];
    }
}
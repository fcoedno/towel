<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 11/08/18
 * Time: 14:49
 */

namespace AppBundle\Service\Importer;

/**
 * Data Importer
 */
interface Importer
{
    /**
     * Reads $source and imports it into domain entities
     *
     * @param $source
     * @return array
     */
    public function import(string $source): array;
}
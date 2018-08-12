<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 18:45
 */

namespace AppBundle\Service\Importer\Factory;


use AppBundle\Service\Importer\Importer;

interface ImporterFactory
{
    /**
     * Makes a importer
     *
     * @return Importer
     */
    public function make(): Importer;
}
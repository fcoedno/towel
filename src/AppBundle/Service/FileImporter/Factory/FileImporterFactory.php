<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 22:06
 */

namespace AppBundle\Service\FileImporter\Factory;


use AppBundle\Service\FileImporter\FileImporter;

interface FileImporterFactory
{
    /**
     * Makes a file importer
     *
     * @return FileImporter
     */
    public function make(): FileImporter;
}
<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 21:59
 */

namespace AppBundle\Service\FileImporter\Decorator;


use AppBundle\Service\FileImporter\FileImporter;

abstract class FileImporterDecorator implements FileImporter
{
    /**
     * @var FileImporter
     */
    private $fileImporter;

    public function __construct(FileImporter $fileImporter)
    {
        $this->fileImporter = $fileImporter;
    }

    /**
     * @inheritDoc
     */
    public function import($source)
    {
        $this->fileImporter->import($source);
    }
}
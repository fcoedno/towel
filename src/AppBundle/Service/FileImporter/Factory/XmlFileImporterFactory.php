<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 22:07
 */

namespace AppBundle\Service\FileImporter\Factory;


use AppBundle\Service\FileImporter\Decorator\SortXmlFiles;
use AppBundle\Service\FileImporter\FileImporter;
use AppBundle\Service\FileImporter\XmlFileImporter;
use AppBundle\Service\Importer\Factory\XmlImporterFactory;

class XmlFileImporterFactory implements FileImporterFactory
{
    /**
     * @var XmlImporterFactory
     */
    private $factory;

    public function __construct(XmlImporterFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * @inheritDoc
     */
    public function make(): FileImporter
    {
        return new SortXmlFiles(
            new XmlFileImporter($this->factory)
        );
    }
}
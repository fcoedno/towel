<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 21:45
 */

namespace AppBundle\Service\FileImporter;

use AppBundle\Service\Importer\Factory\XmlImporterFactory;


class XmlFileImporter implements FileImporter
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
    public function import($source)
    {
        $files = is_array($source) ? $source : [$source];
        array_walk($files, [$this, 'importXml']);
    }

    /**
     * Imports a xml file
     *
     * @param \SplFileInfo $file
     */
    private function importXml(\SplFileInfo $file)
    {
        $xmlImporter = $this->factory->make();
        $xmlImporter->import(
            file_get_contents($file->getRealPath())
        );
    }
}
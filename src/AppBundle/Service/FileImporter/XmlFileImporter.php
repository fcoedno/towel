<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 21:45
 */

namespace AppBundle\Service\FileImporter;


use AppBundle\Service\Importer\XmlImporter;

class XmlFileImporter implements FileImporter
{
    /**
     * @var XmlImporter
     */
    private $importer;

    public function __construct(XmlImporter $importer)
    {
        $this->importer = $importer;
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
        $this->importer->import(file_get_contents($file->getRealPath()));
    }
}
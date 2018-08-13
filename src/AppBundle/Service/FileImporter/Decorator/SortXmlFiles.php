<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 22:00
 */

namespace AppBundle\Service\FileImporter\Decorator;


class SortXmlFiles extends FileImporterDecorator
{
    /**
     * @inheritDoc
     */
    public function import($source)
    {
        if (is_array($source)) {
            usort($source, [$this, 'sortXml']);
        }

        parent::import($source);
    }

    /**
     * Sorter function
     *
     * @param \SplFileInfo $firstFile
     * @param \SplFileInfo $secondFile
     * @return int
     */
    private function sortXml(\SplFileInfo $firstFile, \SplFileInfo $secondFile)
    {
        $firstXml = simplexml_load_file($firstFile->getRealPath());
        $secondXml = simplexml_load_file($secondFile->getRealPath());

        if (!$firstXml || !$secondXml) {
            return 0;
        }

        if ('people' === $firstXml->getName()) {
            return 1;
        }

        if ('people' === $secondXml->getName()) {
            return -1;
        }

        return 0;
    }
}
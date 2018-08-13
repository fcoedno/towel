<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 21:43
 */

namespace AppBundle\Service\FileImporter;


interface FileImporter
{
    /**
     * @param \SplFileInfo[]|\SplFileInfo $source
     */
    public function import($source);
}
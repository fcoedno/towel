<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 21:46
 */

namespace AppBundle\Tests\Unit\Service\FileImporter;


use AppBundle\Service\FileImporter\XmlFileImporter;
use AppBundle\Service\Importer\XmlImporter;
use PHPUnit\Framework\TestCase;
use \Mockery as m;

class XmlFileImporterTest extends TestCase
{
    protected function tearDown()
    {
        m::close();
    }

    /**
     * @test
     */
    public function import_XmlFileGiven_ShouldCallImporterWithTheFileContents()
    {
        $fileName = __DIR__ . '/../../../Resources/people.xml';
        $importer = m::mock(XmlImporter::class)
            ->shouldReceive('import')
            ->with(file_get_contents($fileName))
            ->once()
            ->getMock()
        ;

        $file = new \SplFileInfo($fileName);
        $fileImporter = new XmlFileImporter($importer);
        $fileImporter->import($file);
        $this->assertTrue(true);
    }
}
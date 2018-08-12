<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 11/08/18
 * Time: 22:15
 */

namespace AppBundle\Tests\Unit\Service\Importer;

use AppBundle\Service\Importer\XmlImporter;

use PHPUnit\Framework\TestCase;

class ExtractorTest extends TestCase
{
    /**
     * @test
     */
    public function extractPeople_ValidPeopleXmlGiven_ShouldReturnACollectionOfPerson()
    {
        $people = [
            (new XmlImporter\Dto\Person())
                ->setPersonid(1)
                ->setPersonname('Name 1')
                ->setPhones(['2345678', '1234567']),
            (new XmlImporter\Dto\Person())
                ->setPersonid(2)
                ->setPersonname('Name 2')
                ->setPhones(['4444444']),
            (new XmlImporter\Dto\Person())
                ->setPersonid(3)
                ->setPersonname('Name 3')
                ->setPhones(['7777777', '8888888'])
        ];

        $extractor = new XmlImporter\Extractor();
        $extracted = $extractor->extractPeople(file_get_contents(__DIR__ . '/people.xml'));
        $this->assertEquals($people, $extracted);
    }
}
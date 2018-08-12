<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 11/08/18
 * Time: 14:03
 */

namespace AppBundle\Tests\Unit\Service\Importer\XmlImporter;

use AppBundle\Entity\Person;
use AppBundle\Service\Importer\XmlImporter;
use PHPUnit\Framework\TestCase;

use AppBundle\Service\Extractor\Dto\Person as PersonDto;

use \Mockery as m;

class PersonImporterTest extends TestCase
{
    /**
     * @var XmlImporter
     */
    private $importer;

    protected function setUp()
    {
        $people = [
            (new PersonDto())
                ->setPersonid(1)
                ->setPersonname('Name 1')
                ->setPhones(['2345678']),
            (new PersonDto())
                ->setPersonid(2)
                ->setPersonname('Name 2')
                ->setPhones(['4444444']),
            (new PersonDto())
                ->setPersonid(3)
                ->setPersonname('Name 3')
                ->setPhones(['7777777'])
        ];

        $extractor = m::mock(\AppBundle\Service\Extractor\Extractor::class)
            ->shouldReceive('extractPeople')
            ->andReturn($people)
            ->getMock()
        ;
        $this->importer = new XmlImporter\PersonImporter($extractor);
    }

    /**
     * @test
     */
    public function import_ValidPeopleXml_ShouldReturnACollectionOfPerson()
    {
        $people = $this->importer->import(file_get_contents(__DIR__ . '/../../../../Resources/people.xml'));
        $this->assertContainsOnlyInstancesOf(Person::class, $people);
        return $people;
    }

    /**
     * @test
     * @depends import_ValidPeopleXml_ShouldReturnACollectionOfPerson
     * @param array $people
     */
    public function import_ValidPeopleXmlGiven_ShouldReturnACollectionWithTheSamePersonQuantity(array $people)
    {
        $this->assertCount(3, $people);
    }

    /**
     * @test
     * @depends import_ValidPeopleXml_ShouldReturnACollectionOfPerson
     * @param array $people
     */
    public function import_ValidPeopleXmlGiven_ShouldReturnTheCorrectPeople(array $people)
    {
        $this->assertEquals(1, $people[0]->getId());
        $this->assertEquals('Name 1', $people[0]->getName());
        $this->assertEquals('2345678', $people[0]->getPhones()->first()->getNumber());

        $this->assertEquals(2, $people[1]->getId());
        $this->assertEquals('Name 2', $people[1]->getName());
        $this->assertEquals('4444444', $people[1]->getPhones()->first()->getNumber());

        $this->assertEquals(3, $people[2]->getId());
        $this->assertEquals('Name 3', $people[2]->getName());
        $this->assertEquals('7777777', $people[2]->getPhones()->first()->getNumber());
    }
}
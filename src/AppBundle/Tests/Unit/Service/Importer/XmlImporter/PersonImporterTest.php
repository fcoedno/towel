<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 11/08/18
 * Time: 14:03
 */

namespace AppBundle\Tests\Unit\Service\Importer\XmlImporter;

use AppBundle\Entity\Person;
use AppBundle\Tests\Mock\InMemoryPersonRepository;
use AppBundle\Service\Importer\XmlImporter;
use PHPUnit\Framework\TestCase;

use AppBundle\Service\Extractor\Dto\Person as PersonDto;

use \Mockery as m;

class PersonImporterTest extends TestCase
{
    /**
     * @var XmlImporter\PersonImporter
     */
    private $importer;

    /**
     * @var InMemoryPersonRepository
     */
    private $repository;

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
        $this->repository = $this->makeRepository();
        $this->importer = new XmlImporter\PersonImporter($extractor, $this->repository);
    }

    /**
     * @test
     */
    public function import_ValidPeopleXmlGiven_ShouldPersistTheSamePersonQuantity()
    {
        $this->importer->import(file_get_contents(__DIR__ . '/../../../../Resources/people.xml'));
        $people = $this->repository->findAll();
        $this->assertCount(3, $people);
    }

    /**
     * @test
     */
    public function import_ValidPeopleXmlGiven_ShouldReturnTheCorrectPeople()
    {
        $person = $this->repository->find(1);
        $this->assertEquals(1, $person->getId());
        $this->assertEquals('Name 1', $person->getName());
        $this->assertEquals('2345678', $person->getPhones()->first()->getNumber());

        $person = $this->repository->find(2);
        $this->assertEquals(2, $person->getId());
        $this->assertEquals('Name 2', $person->getName());
        $this->assertEquals('4444444', $person->getPhones()->first()->getNumber());

        $person = $this->repository->find(3);
        $this->assertEquals(3, $person->getId());
        $this->assertEquals('Name 3', $person->getName());
        $this->assertEquals('7777777', $person->getPhones()->first()->getNumber());
    }

    private function makeRepository()
    {
        static $repository = null;
        if (is_null($repository)){
            $repository = new InMemoryPersonRepository();
        }

        return $repository;
    }
}
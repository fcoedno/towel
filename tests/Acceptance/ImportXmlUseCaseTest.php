<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use App\Tests\TestCase;
use Towel\Application\ImportXml\ImportXmlRequest;
use Towel\Application\ImportXml\ImportXmlUseCase;
use Towel\Domain\Model\Person\Person;
use Towel\Domain\Model\Person\PersonId;
use Towel\Domain\Model\Person\PersonName;
use Towel\Domain\Model\Person\PersonRepository;
use Towel\Domain\Model\Person\Phone;
use Towel\Infra\Persistence\InMemory\InMemoryPersonRepository;

class ImportXmlUseCaseTest extends TestCase
{
    /**
     * @var PersonRepository
     */
    private $repository;
    /**
     * @var ImportXmlUseCase
     */
    private $useCase;

    protected function setUp()
    {
        $this->repository = new InMemoryPersonRepository();
        $this->useCase = new ImportXmlUseCase($this->repository);
    }

    /**
     * @test
     */
    public function import_persistsPeople_whenAValidPeopleXmlIsGiven()
    {
        $request = new ImportXmlRequest($this->getResource('people1.xml'));
        $this->useCase->import($request);
        $person = $this->repository->find(new PersonId(1));
        $expectedPerson = new Person(
            new PersonId(1),
            new PersonName('Person 1'),
            [new Phone('2345678'), new Phone('1234567')]
        );
        $this->assertEquals($expectedPerson, $person);
    }

    /**
     * @test
     */
    public function import_persistsMoreThanOnePerson_whenAValidPeopleXmlIsGiven()
    {
        $request = new ImportXmlRequest($this->getResource('people2.xml'));
        $this->useCase->import($request);
        $expectedPeople = [
            new Person(
                new PersonId(1),
                new PersonName('Person 1'),
                [new Phone('2345678'), new Phone('1234567')]
            ),
            new Person(
                new PersonId(2),
                new PersonName('John Doe')
            )
        ];
        $actualPeople = [$this->repository->find(new PersonId(1)), $this->repository->find(new PersonId(2))];
        $this->assertEquals($expectedPeople, $actualPeople);
    }
}
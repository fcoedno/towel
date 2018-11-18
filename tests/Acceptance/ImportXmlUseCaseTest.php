<?php

declare(strict_types=1);

namespace App\Tests\Acceptance;

use PHPUnit\Framework\TestCase;
use Towel\Application\ImportXml\ImportXmlRequest;
use Towel\Application\ImportXml\ImportXmlUseCase;
use Towel\Domain\Model\Person\Person;
use Towel\Domain\Model\Person\PersonId;
use Towel\Domain\Model\Person\PersonName;
use Towel\Domain\Model\Person\Phone;
use Towel\Infra\Persistence\InMemory\InMemoryPersonRepository;

class ImportXmlUseCaseTest extends TestCase
{
    /**
     * @test
     */
    public function import_persistsPeople_whenAValidPeopleXmlIsGiven()
    {
        $repostiroy = new InMemoryPersonRepository();
        $useCase = new ImportXmlUseCase($repostiroy);
        $request = new ImportXmlRequest('');
        $useCase->import($request);
        $person = $repostiroy->find(new PersonId(1));
        $expectedPerson = new Person(
            new PersonId(1),
            new PersonName('Person 1'),
            [new Phone('2345678'), new Phone('1234567')]
        );
        $this->assertEquals($expectedPerson, $person);
    }
}
<?php

declare(strict_types=1);

namespace Towel\Application\ImportXml;

use Towel\Domain\Model\Person\Person;
use Towel\Domain\Model\Person\PersonId;
use Towel\Domain\Model\Person\PersonName;
use Towel\Domain\Model\Person\PersonRepository;
use Towel\Domain\Model\Person\Phone;

class ImportXmlUseCase
{
    /**
     * @var PersonRepository
     */
    private $personRepository;

    public function __construct(PersonRepository $personRepository)
    {
        $this->personRepository = $personRepository;
    }

    public function import(ImportXmlRequest $request)
    {
        $person = new Person(
            new PersonId(1),
            new PersonName('Person 1'),
            [new Phone('2345678'), new Phone('1234567')]
        );
        $this->personRepository->add($person);
    }
}
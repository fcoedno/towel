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
        $xml = simplexml_load_file($request->getXmlPath());
        $peopleXml = $xml->person;
        foreach ($peopleXml as $personXml) {
            $this->importPerson($personXml);
        }
    }

    /**
     * @param $personXml
     */
    private function importPerson($personXml): void
    {
        $phones = [];
        $phonesXml = $personXml->phones->phone ?? [];
        foreach ($phonesXml as $phone) {
            $phones[] = new Phone((string)$phone);
        }
        $person = new Person(
            new PersonId((int)$personXml->personid),
            new PersonName((string)$personXml->personname),
            $phones
        );
        $this->personRepository->add($person);
    }
}
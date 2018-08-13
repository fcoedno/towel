<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 13:46
 */

namespace AppBundle\Service\Importer\XmlImporter;


use AppBundle\Repository\Contract\PersonRepository;
use AppBundle\Repository\Exception\PersonNotFoundException;
use AppBundle\Service\Extractor\Extractor;
use AppBundle\Service\Importer\XmlImporter;
use AppBundle\Entity\Person;
use AppBundle\Service\Extractor\Dto\Person as PersonDto;

class PersonImporter extends XmlImporter
{
    /**
     * @var Extractor
     */
    private $extractor;
    /**
     * @var PersonRepository
     */
    private $repository;

    public function __construct(Extractor $extractor, PersonRepository $repository)
    {
        $this->extractor = $extractor;
        $this->repository = $repository;
    }

    /**
     * @inheritdoc
     */
    public function import(string $source)
    {
        if ('people' === simplexml_load_string($source)->getName()) {
            $people = $this->extractor->extractPeople($source);
            array_walk($people, [$this, 'importPerson']);
            return;
        }

        parent::import($source);
    }

    /**
     * @param PersonDto $personDto
     */
    private function importPerson(PersonDto $personDto)
    {
        $person = $this->getPerson($personDto->getPersonid());
        $person->setName($personDto->getPersonname());
        $person->getPhones()->clear();
        foreach ($personDto->getPhones() as $phoneNumber) {
            $person->addPhone($phoneNumber);
        }
        $this->repository->save($person);
    }

    /**
     * @param $id
     * @return Person
     */
    private function getPerson($id)
    {
        try {
            return $this->repository->find($id);
        } catch (PersonNotFoundException $exception) {
            return (new Person())->setId($id);
        }
    }
}
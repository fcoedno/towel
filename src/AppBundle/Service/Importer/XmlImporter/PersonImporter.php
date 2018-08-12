<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 13:46
 */

namespace AppBundle\Service\Importer\XmlImporter;


use AppBundle\Repository\Contract\PersonRepository;
use AppBundle\Service\Extractor\Extractor;
use AppBundle\Service\Importer\XmlImporter;
use AppBundle\Entity\Person;

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
        $people = $this->extractor->extractPeople($source);
        foreach ($people as $person) {
            $person = new Person($person->getPersonid(), $person->getPersonname(), $person->getPhones());
            $this->repository->save($person);
        }
    }
}
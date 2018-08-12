<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 18:56
 */

namespace AppBundle\Tests\Integration;


use AppBundle\Repository\Contract\OrderRepository;
use AppBundle\Repository\Contract\PersonRepository;
use AppBundle\Service\Extractor\Extractor;
use AppBundle\Service\Importer\Importer;
use AppBundle\Service\Importer\XmlImporter\OrderImporter;
use AppBundle\Service\Importer\XmlImporter\PersonImporter;
use AppBundle\Tests\Mock\InMemoryOrderRepository;
use AppBundle\Tests\Mock\InMemoryPersonRepository;
use PHPUnit\Framework\TestCase;

class XmlImporterTest extends TestCase
{
    /**
     * @var Importer
     */
    private $importer;
    /**
     * @var PersonRepository
     */
    private $personRepository;
    /**
     * @var OrderRepository
     */
    private $orderRepository;

    protected function setUp()
    {
        $extractor = new Extractor();
        $this->personRepository = $this->makePersonRepository();
        $this->orderRepository = $this->makeOrderRepository();

        $personImporter = new PersonImporter($extractor, $this->personRepository);
        $orderImporter = new OrderImporter($extractor, $this->personRepository, $this->orderRepository);
        $personImporter->setNext($orderImporter);
        $this->importer = $personImporter;
    }

    /**
     * @test
     */
    public function import_PeopleXmlGiven_ShouldImportPeople()
    {
        $xml = file_get_contents(__DIR__ . '/../Resources/people.xml');
        $this->importer->import($xml);
        $person = $this->personRepository->find(1);
        $this->assertEquals('Name 1', $person->getName());
    }

    /**
     * @test
     */
    public function import_OrderXmlGiven_ShouldImportOrder()
    {
        $orderXml = file_get_contents(__DIR__ . '/../Resources/shiporders.xml');
        $this->importer->import($orderXml);
        $order = $this->orderRepository->find(1);
        $this->assertEquals('Name 1', $order->getPerson()->getName());
    }

    private function makePersonRepository()
    {
        static $repository = null;
        if (is_null($repository)) {
            $repository = new InMemoryPersonRepository();
        }
        return $repository;
    }

    private function makeOrderRepository()
    {
        static $repository = null;
        if (is_null($repository)) {
            $repository = new InMemoryOrderRepository();
        }
        return $repository;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 16:18
 */

namespace AppBundle\Tests\Unit\Service\Importer\XmlImporter;


use AppBundle\Entity\OrderItem;
use AppBundle\Entity\Person;
use AppBundle\Repository\Contract\PersonRepository;
use AppBundle\Service\Extractor\Dto\Item;
use AppBundle\Service\Extractor\Dto\ShipOrder;
use AppBundle\Service\Extractor\Dto\ShipTo;
use AppBundle\Service\Extractor\Extractor;
use AppBundle\Service\Importer\XmlImporter\OrderImporter;
use AppBundle\Tests\Mock\InMemoryOrderRepository;
use PHPUnit\Framework\TestCase;
use \Mockery as m;

class OrderImporterTest extends TestCase
{
    /**
     * @var InMemoryOrderRepository
     */
    private $orderRepository;
    /**
     * @var OrderImporter
     */
    private $importer;

    protected function setUp()
    {
        $extractor = m::mock(Extractor::class)
            ->shouldReceive('extractShipOrders')
            ->andReturn([
                (new ShipOrder())
                    ->setOrderid(1)
                    ->setOrderperson(1)
                    ->setShipto(
                        (new ShipTo())
                            ->setName('Name 1')
                            ->setAddress('Address 1')
                            ->setCity('City 1')
                            ->setCountry('Country 1')
                    )
                    ->setItems([
                        (new Item())
                            ->setTitle('Title 1')
                            ->setNote('Note 1')
                            ->setQuantity(745)
                            ->setPrice(123.45)
                    ])
            ])
            ->getMock()
        ;
        $samplePerson = (new Person())->setId(1)->setName('Name 1');
        $personRepository = m::mock(PersonRepository::class)
            ->shouldReceive('find')
            ->andReturn($samplePerson)
            ->getMock()
        ;
        $this->orderRepository = $this->makeRepository();
        $this->importer = new OrderImporter($extractor, $personRepository, $this->orderRepository);
    }

    /**
     * @test
     */
    public function import_ValidXmlGiven_ShouldPersistTheSameOrderQuantity()
    {
        $this->importer->import(file_get_contents(__DIR__ . '/../../../../Resources/shiporders_simple.xml'));
        $orders = $this->orderRepository->findAll();
        $this->assertCount(1, $orders);
    }

    /**
     * @test
     */
    public function import_ValidXmlGiven_ShouldPersistTheCorrectOrder()
    {
        $order = $this->orderRepository->find(1);
        $address = $order->getShippingAddress();

        $this->assertEquals(1, $order->getId());
        $this->assertEquals(1, $order->getPerson()->getId());
        $this->assertEquals('Name 1', $address->getName());
        $this->assertEquals('Address 1', $address->getAddress());
        $this->assertEquals('City 1', $address->getCity());
        $this->assertEquals('Country 1', $address->getCountry());

        $this->assertCount(1, $order->getItems());

        /** @var OrderItem $item */
        $item = $order->getItems()->first();
        $this->assertEquals('Title 1', $item->getTitle());
        $this->assertEquals('Note 1', $item->getNote());
        $this->assertEquals(745, $item->getQuantity());
        $this->assertEquals(123.45, $item->getPrice());
    }

    /**
     * @return InMemoryOrderRepository
     */
    private function makeRepository()
    {
        static $repository = null;
        if (is_null($repository)) {
            $repository = new InMemoryOrderRepository();
        }
        return $repository;
    }
}
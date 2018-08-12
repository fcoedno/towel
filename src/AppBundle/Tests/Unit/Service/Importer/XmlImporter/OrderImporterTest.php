<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 16:18
 */

namespace AppBundle\Tests\Unit\Service\Importer\XmlImporter;


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
     * @test
     */
    public function import_ValidXmlGiven_ShouldPersistTheSameOrderQuantity()
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
        $personRepository = m::mock(PersonRepository::class)
            ->shouldReceive('find')
            ->andReturn(new Person(1, 'Name 1'))
            ->getMock()
        ;
        $orderRepository = new InMemoryOrderRepository();
        $orderImporter = new OrderImporter($extractor, $personRepository, $orderRepository);
        $orderImporter->import(file_get_contents(__DIR__ . '/../../../../Resources/shiporders_simple.xml'));
        $orders = $orderRepository->findAll();
        $this->assertCount(1, $orders);
    }
}
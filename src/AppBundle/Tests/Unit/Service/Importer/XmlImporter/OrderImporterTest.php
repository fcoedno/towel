<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 16:18
 */

namespace AppBundle\Tests\Unit\Service\Importer\XmlImporter;


use AppBundle\Service\Extractor\Extractor;
use AppBundle\Service\Importer\XmlImporter\OrderImporter;
use AppBundle\Tests\Mock\InMemoryOrderRepository;
use PHPUnit\Framework\TestCase;

class OrderImporterTest extends TestCase
{
    /**
     * @test
     */
    public function import_ValidXmlGiven_ShouldPersistTheSameOrderQuantity()
    {
        $orderRepository = new InMemoryOrderRepository();
        $orderImporter = new OrderImporter($orderRepository);
        $orderImporter->import(file_get_contents(__DIR__ . '/../../../../Resources/shiporders_simple.xml'));
        $orders = $orderRepository->findAll();
        $this->assertCount(1, $orders);
    }
}
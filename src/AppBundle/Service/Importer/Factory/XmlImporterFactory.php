<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 18:46
 */

namespace AppBundle\Service\Importer\Factory;


use AppBundle\Service\Importer\Importer;
use AppBundle\Service\Importer\XmlImporter\PersonImporter;
use Symfony\Component\DependencyInjection\Container;

class XmlImporterFactory implements ImporterFactory
{
    /**
     * @var Container
     */
    private $container;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @inheritDoc
     */
    public function make(): Importer
    {
        $personImporter = $this->container->get('service.importer.xml_importer.person_importer');
        $orderImporter = $this->container->get('service.importer.xml_importer.order_importer');
        $personImporter->setNext($orderImporter);
        return $personImporter;
    }
}
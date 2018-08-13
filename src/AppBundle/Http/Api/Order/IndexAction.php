<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 23:27
 */

namespace AppBundle\Http\Api\Order;


use AppBundle\Repository\Contract\OrderRepository;
use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route(service="http.api.order.index_action")
 */
class IndexAction
{
    /**
     * @var OrderRepository
     */
    private $repository;
    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(OrderRepository $repository, SerializerInterface $serializer)
    {
        $this->repository = $repository;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/api/orders")
     * @Method("GET")
     *
     * @ApiDoc(
     *     description="Gets a list of orders",
     *     output="AppBundle\Entity\Order"
     * )
     */
    public function __invoke()
    {
        $orders = $this->repository->findAll();
        $data = $this->serializer->serialize($orders, 'json');
        return new Response($data, 200, ['Content-Type' => 'application/json']);
    }
}
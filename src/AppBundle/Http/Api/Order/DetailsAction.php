<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 12/08/18
 * Time: 23:58
 */

namespace AppBundle\Http\Api\Order;


use AppBundle\Repository\Contract\OrderRepository;
use AppBundle\Repository\Exception\OrderNotFoundException;
use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route(service="http.api.order.details_action")
 */
class DetailsAction
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
     * @Route("/api/orders/{id}", name="api.order.details", requirements={"id"="\d+"})
     * @Method("GET")
     *
     * @ApiDoc(
     *     description="Get a specific order",
     *     output="AppBundle\Entity\Order"
     * )
     *
     * @param $id
     * @return Response
     */
    public function __invoke($id)
    {
        try {
            $order = $this->repository->find($id);
            $data = $this->serializer->serialize($order, 'json');
            return new Response($data, 200, ['Content-Type' => 'application/json']);
        } catch (OrderNotFoundException $exception) {
            return new JsonResponse([
                'message' => 'The order was not found'
            ], 404);
        } catch (\Throwable $exception) {
            return new JsonResponse([
                'message' => 'Something went wrong, sorry!'
            ], 500);
        }
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 13/08/18
 * Time: 00:09
 */

namespace AppBundle\Http\Api\Person;


use AppBundle\Repository\Contract\PersonRepository;
use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route(service="http.api.person.index_action")
 */
class IndexAction
{
    /**
     * @var PersonRepository
     */
    private $repository;
    /**
     * @var SerializerInterface
     */
    private $serializer;

    public function __construct(PersonRepository $repository, SerializerInterface $serializer)
    {
        $this->repository = $repository;
        $this->serializer = $serializer;
    }

    /**
     * @Route("/api/people", name="api.people.index")
     * @Method("GET")
     *
     * @ApiDoc(
     *     description="Gets a list of people",
     *     output="AppBundle\Entity\Person"
     * )
     *
     * @return JsonResponse|Response
     */
    public function __invoke()
    {
        try {
            $people = $this->repository->findAll();
            $data = $this->serializer->serialize($people, 'json');
            return new Response($data, 200, ['Content-Type' => 'application/json']);
        } catch (\Throwable $exception) {
            return new JsonResponse([
                'message' => 'Sorry, something went wrong :('
            ], 500);
        }
    }
}
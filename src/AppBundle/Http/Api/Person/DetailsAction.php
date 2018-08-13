<?php
/**
 * Created by PhpStorm.
 * User: edno
 * Date: 13/08/18
 * Time: 00:16
 */

namespace AppBundle\Http\Api\Person;


use AppBundle\Repository\Contract\PersonRepository;
use AppBundle\Repository\Exception\PersonNotFoundException;
use JMS\Serializer\SerializerInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route(service="http.api.person.details_action")
 */
class DetailsAction
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
     * @Route("/api/people/{id}")
     * @Method("GET")
     *
     * @ApiDoc(
     *     description="Gets the details of a specific person",
     *     output="AppBundle\Entity\Person"
     * )
     *
     * @param $id
     * @return Response
     */
    public function __invoke($id)
    {
        try {
            $person = $this->repository->find($id);
            $data = $this->serializer->serialize($person, 'json');
            return new Response($data, 200, ['Content-Type' => 'application/json']);
        } catch (PersonNotFoundException $exception) {
            return new JsonResponse([
                'message' => 'The person was not found'
            ], 404);
        } catch (\Throwable $exception) {
            return new JsonResponse([
                'message' => 'Sorry, something went wrong :('
            ]);
        }
    }
}
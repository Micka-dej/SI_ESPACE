<?php

namespace App\Controller\API;

use App\Entity\SpaceShip;
use CreamIO\BaseBundle\Service\APIService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Class SpaceShipController
 *
 * @Route("/api", name="api_")
 */
class SpaceShipController extends Controller
{
    private const ACCEPTED_CONTENT_TYPE = 'json';

    /**
     * @Route("/spaceship", name="space_ship_index", methods="GET")
     */
    public function index(Request $request, APIService $APIService): JsonResponse
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(SpaceShip::class);
        $spaceships = $repo->findAll();

        return $APIService->successWithResults($spaceships, 200, 'list-spaceships', $request);
    }

    /**
     * @Route("/spaceship/{id}", name="space_ship_show", methods="GET")
     */
    public function show(SpaceShip $spaceship, Request $request, APIService $APIService): JsonResponse
    {

        return $APIService->successWithResults($spaceship, 200, '',$request);
    }

    /**
     * @Route("/spaceship/{id}", name="space_ship_delete", methods="DELETE")
     */
    public function delete(SpaceShip $spaceship, Request $request, APIService $APIService): JsonResponse
    {

        $em = $this->getDoctrine()->getManager();
        $spaceshipID = $spaceship->getId();
        $em->remove($spaceship);
        $em->flush();

        return $APIService->successWithoutResultsRedirected($spaceshipID, $request, Response::HTTP_OK, "/api/spaceship");
    }

    /**
     * @Route("/spaceship", name="space_ship_add", methods="POST")
     */
    public function add(Request $request, APIService $APIService): JsonResponse
    {
        if ($request->getContentType() !== self::ACCEPTED_CONTENT_TYPE) {
            throw $APIService->error(Response::HTTP_BAD_REQUEST,'Bad content type. Use application/json instead.'.$request->getContentType());
        }
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        $content = $request->getContent();
        /** @var SpaceShip $spaceship */
        $spaceship = $serializer->deserialize($content, Spaceship::class, 'json');
        $APIService->validateEntity($spaceship);
        $em = $this->getDoctrine()->getManager();
        $em->persist($spaceship);
        $em->flush();

        return $APIService->successWithResults($spaceship, 200, $spaceship->getId(), $request);

    }
}

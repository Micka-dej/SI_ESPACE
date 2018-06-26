<?php

namespace App\Controller\API;

use App\Entity\SpaceShip;
use App\Service\SpaceShipService;
use CreamIO\BaseBundle\Exceptions\APIError;
use CreamIO\BaseBundle\Exceptions\APIException;
use CreamIO\BaseBundle\Service\APIService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SpaceShipController.
 *
 * @Route("/api", name="api_")
 */
class SpaceShipController extends Controller
{
    private const ACCEPTED_CONTENT_TYPE = 'application/json';
    private const LIST_RESULTS_FOR_IDENTIFIER = 'spaceships-list';

    /**
     * Spaship details route.
     *
     * @Route("/spaceship", name="spaceship_list", methods="GET")
     *
     * @param Request    $request    Handled HTTP request
     * @param APIService $APIService Base API Service
     *
     * @return JsonResponse
     */
    public function list(Request $request, APIService $APIService): JsonResponse
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(SpaceShip::class);
        $spaceshipsList = $repo->findAll();

        return $APIService->successWithResults(['users' => $spaceshipsList], Response::HTTP_OK, self::LIST_RESULTS_FOR_IDENTIFIER, $request);
    }

    /**
     * Spaship details route.
     *
     * @Route("/spaceship/{id}", name="spaceship_details", methods="GET")
     *
     * @param Request    $request    Handled HTTP request
     * @param APIService $APIService Base API Service
     * @param int        $id         User id to get information for
     *
     * @return JsonResponse
     */
    public function show(Request $request, APIService $APIService, int $id): JsonResponse
    {
        $spaceship = $this->getDoctrine()->getManager()->getRepository(SpaceShip::class)->find($id);
        if (null === $spaceship) {
            throw $APIService->error(Response::HTTP_NOT_FOUND, APIError::RESOURCE_NOT_FOUND);
        }

        return $APIService->successWithResults(['spaceship' => $spaceship], Response::HTTP_OK, $spaceship->getId(), $request);
    }

    /**
     * Spaceship deletion route.
     *
     * @Route("/spaceship/{id}", name="spaceship_delete", methods="DELETE")
     *
     * @param Request    $request    Handled HTTP request
     * @param int        $id         User id to delete
     * @param APIService $APIService Base API Service
     *
     * @throws \LogicException
     * @throws APIException
     *
     * @return JsonResponse
     */
    public function delete(Request $request, APIService $APIService, int $id): JsonResponse
    {
        $em = $this->getDoctrine()->getManager();
        $spaceShip = $em->getRepository(SpaceShip::class)->find($id);
        if (null === $spaceShip) {
            throw $APIService->error(Response::HTTP_NOT_FOUND, APIError::RESOURCE_NOT_FOUND);
        }
        $em->remove($spaceShip);
        $em->flush();

        return $APIService->successWithoutResults($id, Response::HTTP_OK, $request);
    }

    /**
     * SpaceShip creation route.
     *
     * @Route("/spaceship", name="user_post", methods="POST")
     *
     * @param Request          $request          Handled HTTP request
     * @param APIService       $APIService       Base API Service
     * @param SpaceShipService $spaceShipService SapceShip Service
     *
     * @return JsonResponse
     */
    public function create(Request $request, APIService $APIService, SpaceShipService $spaceShipService): JsonResponse
    {
        if (self::ACCEPTED_CONTENT_TYPE !== $request->headers->get('content_type')) {
            throw $APIService->error(Response::HTTP_BAD_REQUEST, APIError::INVALID_CONTENT_TYPE);
        }
        $data = $request->getContent();
        $spaceShip = $spaceShipService->generateSpaceShipFromJSON($data);
        $APIService->validateEntity($spaceShip);
        $em = $this->getDoctrine()->getManager();
        $em->persist($spaceShip);
        $em->flush();
        $redirectionUrl = $this->generateUrl('api_spaceship_details', ['id' => $spaceShip->getId()]);

        return $APIService->successWithoutResultsRedirected($spaceShip->getId(), $request, Response::HTTP_CREATED, $redirectionUrl);
    }
}

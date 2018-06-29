<?php

namespace App\Controller\API;

use App\Entity\SpaceShip;
use App\Service\SpaceShipService;
use CreamIO\BaseBundle\Exceptions\APIError;
use CreamIO\BaseBundle\Exceptions\APIException;
use CreamIO\BaseBundle\Service\APIService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

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
     * @IsGranted("ROLE_MEMBER", statusCode=401, message="Access denied")
     *
     * @param Request    $request    Handled HTTP request
     * @param APIService $APIService Base API Service
     *
     * @return JsonResponse
     */
    public function list(Request $request, APIService $APIService, SpaceShipService $spaceShipService): JsonResponse
    {
        $user = $this->getUser();
        if (null === $user) {
            throw new AccessDeniedException();
        }
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(SpaceShip::class);
        $spaceshipsList = $repo->findByRelatedUser($user);

        return $APIService->successWithResults(['spaceships' => $spaceshipsList], Response::HTTP_OK, self::LIST_RESULTS_FOR_IDENTIFIER, $request, $spaceShipService->generateSerializer());
    }

    /**
     * Spaship details route.
     *
     * @Route("/spaceship/{id}", name="spaceship_details", methods="GET")
     *
     * @IsGranted("ROLE_MEMBER", statusCode=401, message="Access denied")
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
     * @IsGranted("ROLE_MEMBER", statusCode=401, message="Access denied")
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
     * @Route("/spaceship", name="spaceship_create", methods="POST")
     *
     * @IsGranted("ROLE_MEMBER", statusCode=401, message="Access denied")
     *
     * @param Request          $request          Handled HTTP request
     * @param APIService       $APIService       Base API Service
     * @param SpaceShipService $spaceShipService SpaceShip Service
     *
     * @return JsonResponse
     */
    public function create(Request $request, APIService $APIService, SpaceShipService $spaceShipService): JsonResponse
    {
        if (self::ACCEPTED_CONTENT_TYPE !== $request->headers->get('content_type')) {
            throw $APIService->error(Response::HTTP_BAD_REQUEST, APIError::INVALID_CONTENT_TYPE);
        }
        $user = $this->getUser();
        if (null === $user) {
            throw new AccessDeniedException();
        }
        $data = $request->getContent();
        $spaceShip = $spaceShipService->generateSpaceShipFromJSON($data, $user);
        $APIService->validateEntity($spaceShip);
        $em = $this->getDoctrine()->getManager();
        $em->persist($spaceShip);
        $em->flush();
        $redirectionUrl = $this->generateUrl('api_spaceship_details', ['id' => $spaceShip->getId()]);

        return $APIService->successWithoutResultsRedirected($spaceShip->getId(), $request, Response::HTTP_CREATED, $redirectionUrl);
    }

    /**
     * SpaceShip add to user route.
     *
     * @Route("/spaceship/addToUser", name="spaceship_add_to_user", methods="POST")
     *
     * @IsGranted("ROLE_MEMBER", statusCode=401, message="Access denied")
     *
     * @param Request          $request          Handled HTTP request
     * @param APIService       $APIService       Base API Service
     * @param SpaceShipService $spaceShipService SpaceShip Service
     *
     * @return JsonResponse
     */
    public function addToUser(Request $request, APIService $APIService, SpaceShipService $spaceShipService): JsonResponse
    {
        $user = $this->getUser();
        if (null === $user) {
            throw $APIService->error(Response::HTTP_FORBIDDEN, 'Access denied');
        }
        if (self::ACCEPTED_CONTENT_TYPE !== $request->headers->get('content_type')) {
            throw $APIService->error(Response::HTTP_BAD_REQUEST, APIError::INVALID_CONTENT_TYPE);
        }
        $data = $request->getContent();
        $spaceShip = $spaceShipService->generateSpaceShipFromJSON($data);
        $APIService->validateEntity($spaceShip);
        $user->addSpaceShip($spaceShip);
        $em = $this->getDoctrine()->getManager();
        $em->persist($spaceShip);
        $em->flush();
        $redirectionUrl = $this->generateUrl('api_spaceship_details', ['id' => $spaceShip->getId()]);

        return $APIService->successWithoutResultsRedirected($spaceShip->getId(), $request, Response::HTTP_CREATED, $redirectionUrl);
    }
}

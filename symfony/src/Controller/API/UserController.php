<?php

namespace App\Controller\API;

use App\Entity\User;
use App\Service\UserService;
use CreamIO\BaseBundle\Exceptions\APIError;
use CreamIO\BaseBundle\Exceptions\APIException;
use CreamIO\BaseBundle\Service\APIService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api", name="api_")
 */
class UserController extends Controller
{
    private const ACCEPTED_CONTENT_TYPE = 'application/json';
    private const LIST_RESULTS_FOR_IDENTIFIER = 'users-list';

    /**
     * User creation route.
     *
     * @Route("/user", name="user_post", methods="POST")
     *
     * @param Request     $request     Handled HTTP request
     * @param APIService  $APIService  Base API Service
     * @param UserService $userService User service
     *
     * @return JsonResponse
     */
    public function create(Request $request, APIService $APIService, UserService $userService): JsonResponse
    {
        if (self::ACCEPTED_CONTENT_TYPE !== $request->headers->get('content_type')) {
            throw $APIService->error(Response::HTTP_BAD_REQUEST, APIError::INVALID_CONTENT_TYPE);
        }
        $data = $request->getContent();
        $user = $userService->generateAppUserFromJSON($data);
        $APIService->validateEntity($user);
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
        $redirectionUrl = $this->generateUrl('api_user_details', ['id' => $user->getId()]);

        return $APIService->successWithoutResultsRedirected($user->getId(), $request, Response::HTTP_CREATED, $redirectionUrl);
    }

    /**
     * User Profile route.
     *
     * @Route("/user/{id}", name="user_details", methods="GET")
     *
     * @IsGranted("ROLE_MEMBER", statusCode=401, message="Access denied")
     *
     * @param Request     $request     Handled HTTP request
     * @param APIService  $APIService  Base API Service
     * @param UserService $userService User service
     * @param int         $id          User id to get information for
     *
     * @return JsonResponse
     */
    public function show(Request $request, APIService $APIService, UserService $userService, int $id): JsonResponse
    {
        $user = $this->getDoctrine()->getManager()->getRepository(User::class)->find($id);
        if (null === $user) {
            throw $APIService->error(Response::HTTP_NOT_FOUND, APIError::RESOURCE_NOT_FOUND);
        }

        return $APIService->successWithResults(['user' => $user], Response::HTTP_OK, $user->getId(), $request, $userService->generateSerializer());
    }

    /**
     * User Profiles list route.
     *
     * @Route("/user", name="user_details_list", methods="GET")
     *
     * @IsGranted("ROLE_ADMIN", statusCode=401, message="Access denied")
     *
     * @param Request     $request     Handled HTTP request
     * @param APIService  $APIService  Base API Service
     * @param UserService $userService User service
     *
     * @return JsonResponse
     */
    public function list(Request $request, APIService $APIService, UserService $userService): JsonResponse
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(User::class);
        $usersList = $repo->findAll();

        return $APIService->successWithResults(['users' => $usersList], Response::HTTP_OK, self::LIST_RESULTS_FOR_IDENTIFIER, $request, $userService->generateSerializer());
    }

    /**
     * User deletion route.
     *
     * @Route("/user/{id}", name="user_delete", methods="DELETE")
     *
     * @IsGranted("ROLE_ADMIN", statusCode=401, message="Access denied")
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
        $user = $em->getRepository(User::class)->find($id);
        if (null === $user) {
            throw $APIService->error(Response::HTTP_NOT_FOUND, APIError::RESOURCE_NOT_FOUND);
        }
        $em->remove($user);
        $em->flush();

        return $APIService->successWithoutResults($id, Response::HTTP_OK, $request);
    }

    /**
     * @Route("/login", name="user_login", methods="POST")
     *
     * @param APIService  $APIService  Base API Service
     * @param Request     $request     Handled HTTP request
     * @param UserService $userService User service
     *
     * @return JsonResponse
     */
    public function login(APIService $APIService, UserService $userService, Request $request)
    {
        $user = $this->getUser();
        if (null === $user) {
            throw $APIService->error(Response::HTTP_FORBIDDEN, APIError::RESOURCE_NOT_FOUND);
        }

        return $APIService->successWithResults(['user' => $user], Response::HTTP_OK, $user->getId(), $request, $userService->generateSerializer());
    }

    /**
     * @Route("/checklogin", name="user_check_login", methods="GET")
     *
     * @return JsonResponse
     */
    public function checkIsLoggedIn(): JsonResponse
    {
        $user = $this->getUser();
        if (null === $user) {
            return new JsonResponse(['Authorization' => false], Response::HTTP_FORBIDDEN);
        }

        return new JsonResponse(['Authorization' => true], Response::HTTP_OK);
    }
}

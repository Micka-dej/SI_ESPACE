<?php

namespace App\Controller\API;

use App\Service\UserService;
use CreamIO\BaseBundle\Exceptions\APIError;
use CreamIO\BaseBundle\Service\APIService;
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
    private const LOGIN_RESULTS_FOR_IDENTIFIER = 'login';

    /**
     * User creation route.
     *
     * @Route("/user", name="user_post", methods="POST")
     *
     * @param Request     $request     Handled HTTP request
     * @param APIService  $APIService
     * @param UserService $userService
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
        //$redirectionUrl = $this->generateUrl('', ['id' => $user->getId()]);
        return $APIService->successWithoutResultsRedirected($user->getId(), $request, Response::HTTP_CREATED, '');
    }

    /**
     * @Route("/login", name="user_login")
     *
     * @param APIService $APIService
     * @param Request    $request
     *
     * @return JsonResponse
     */
    public function login(APIService $APIService, Request $request)
    {
        return $APIService->successWithResults('Authentication succeed', 200, 'auth', $request);
    }
}

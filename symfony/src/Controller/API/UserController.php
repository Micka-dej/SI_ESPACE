<?php

namespace App\Controller\API;

use CreamIO\BaseBundle\Service\APIService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/api", name="api_")
 */
class UserController extends Controller
{
    /**
     * @Route("/login", name="user_login")
     */
    public function login(APIService $APIService, Request $request)
    {
        return $APIService->successWithResults('Authentication succeed', 200, 'auth', $request);
    }
}

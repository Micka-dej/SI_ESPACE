<?php

namespace App\Controller\API;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/dummy", name="dummy_")
 */
class DummyController extends Controller
{
    /**
     * Return some dummy shit data for tests.
     *
     * @Route("/", name="index", methods="GET")
     *
     * @return Response
     */
    public function list(): Response
    {
        $dummyData = [
            [
                'id' => 0,
                'name' => 'Saint-Louis',
                'description' => 'Croisade contre Saladin à Damas',
            ],
            [
                'id' => 1,
                'name' => 'Jean-Marie Le Pen',
                'description' => 'Croisade contre les islamo-racailles à Saint-Cloud',
            ],
        ];

        return new JsonResponse($dummyData, Response::HTTP_OK);
    }
}

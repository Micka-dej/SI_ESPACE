<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BiteController extends Controller
{
    /**
     * @Route("/bite", name="bite")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcomeeee to your new controller!',
            'path' => 'src/Controller/BiteController.php',
        ]);
    }
}

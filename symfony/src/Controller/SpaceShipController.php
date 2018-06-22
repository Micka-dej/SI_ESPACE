<?php

namespace App\Controller;

use App\Entity\SpaceShip;
use App\Form\SpaceShipType;
use App\Repository\SpaceShipRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/spaceship")
 */
class SpaceShipController extends Controller
{
    /**
     * @Route("/", name="space_ship_index", methods="GET")
     */
    public function index(SpaceShipRepository $spaceShipRepository): Response
    {
        return $this->render('space_ship/index.html.twig', ['space_ships' => $spaceShipRepository->findAll()]);
    }

    /**
     * @Route("/new", name="space_ship_new", methods="GET|POST")
     */
    public function new(Request $request): Response
    {
        $spaceShip = new SpaceShip();
        $form = $this->createForm(SpaceShipType::class, $spaceShip);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($spaceShip);
            $em->flush();

            return $this->redirectToRoute('space_ship_index');
        }

        return $this->render('space_ship/new.html.twig', [
            'space_ship' => $spaceShip,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="space_ship_show", methods="GET")
     */
    public function show(SpaceShip $spaceShip): Response
    {
        return $this->render('space_ship/show.html.twig', ['space_ship' => $spaceShip]);
    }

    /**
     * @Route("/{id}/edit", name="space_ship_edit", methods="GET|POST")
     */
    public function edit(Request $request, SpaceShip $spaceShip): Response
    {
        $form = $this->createForm(SpaceShipType::class, $spaceShip);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('space_ship_edit', ['id' => $spaceShip->getId()]);
        }

        return $this->render('space_ship/edit.html.twig', [
            'space_ship' => $spaceShip,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="space_ship_delete", methods="DELETE")
     */
    public function delete(Request $request, SpaceShip $spaceShip): Response
    {
        if ($this->isCsrfTokenValid('delete'.$spaceShip->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($spaceShip);
            $em->flush();
        }

        return $this->redirectToRoute('space_ship_index');
    }
}

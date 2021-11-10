<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Annonce;

class AnnonceController extends AbstractController
{
    /**
     * @Route("/annonce", name="annonce")
     *  @return Response
     */
    public function index(): Response
    {

        $annonce = $this->getDoctrine()
        ->getRepository(Annonce::class)
        ->findAll();
        return $this->render('annonce/index.html.twig', [
            'annonce' => $annonce]
        );
    }
}

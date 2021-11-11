<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Annonce;
use App\Form\AnnonceType;
use App\Service\FileUploader;
use Symfony\Component\String\Slugger\SluggerInterface;

class AnnonceController extends AbstractController
{

    /**
     * @Route("/annonce", name="annonce")
     *  @return Response
     */
    public function show(): Response
    {

        $annonce = $this->getDoctrine()
        ->getRepository(Annonce::class)
        ->findAll();
        
        return $this->render('annonce/index.html.twig', [
            'annonce' => $annonce]
        );
    }
}

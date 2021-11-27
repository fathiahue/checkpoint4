<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Annonce;
use App\Form\AnnonceType;
use App\Entity\User;
use App\Repository\AnnonceRepository;
use App\Service\FileUploader;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;

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





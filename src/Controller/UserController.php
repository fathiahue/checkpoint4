<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\UserRepository;
use App\Repository\AnnonceRepository;
use App\Entity\User;
use App\Entity\Annonce;
use App\Service\FileUploader;
use App\Form\EditProfileType;
use App\Form\AnnoncesType;
use Symfony\Component\String\Slugger\SluggerInterface;

class UserController extends AbstractController
{
    #[Route('/user', name: 'user')]
    public function index(): Response
    {
        return $this->render('user/index.html.twig', [
            'controller_name' => 'UserController',
        ]);
    }
    

     /**
     * @Route("/editprofileuser", name="edit_profil_user")
     */
    public function editprofile(Request $request,EntityManagerInterface $entityManager,UserRepository $userRepository,SluggerInterface $slugger): Response
    {
        if ($this->getUser() !== null) {

            /** @var \App\Entity\User $user */
            $user = $this->getUser();
        }
        
       
        $form = $this->createForm(EditProfileType::class,$user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();
      
        $this->addFlash('success', 'Votre profile a était modifier');
        return $this->redirectToRoute('home');
        }
        return $this->render('user/editprofile.html.twig', [
           'form' => $form->createView()
        ]);
    }


    /**
     * @Route("/annonce/{id}/delete", name="annonce_delete")
     */
    public function delete(Annonce $annonce):Response

    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($annonce);
        $entityManager->flush();
        $this->addFlash('success', 'Votre annonce à bien été supprimer');

        return $this->redirectToRoute("home");
    }


       /**
     * @Route("/annonce/{id}/edit", name="edit_annonce")
     */
    public function editannonce(int $id,Request $request,EntityManagerInterface $entityManager,UserRepository $userRepository,SluggerInterface $slugger): Response
    {
        if ($this->getUser() !== null) {

            /** @var \App\Entity\User $user */
            $user = $this->getUser();
        }
        
        $annonce = new Annonce();
        $annonce = $this->getDoctrine()
        ->getRepository(Annonce::class)
        ->findOneBy(['id' => $id]);

    if (!$annonce) {
        throw $this->createNotFoundException(
            'No annonce with id : '.$id.' found in annonce\'s table.'
        );
    }
        $form = $this->createForm(AnnoncesType::class,$annonce);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($annonce);
        $entityManager->flush();
      
        $this->addFlash('success', 'Votre annonce a était modifier');
        return $this->redirectToRoute('home');
        }
        return $this->render('user/editannonce.html.twig', [
           
            'form' => $form->createView(),
            'annonce' => $annonce
        ]);
    }
}


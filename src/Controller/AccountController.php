<?php

namespace App\Controller;

use App\Form\AccountType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AccountController extends AbstractController
{
    #Permet d'afficher et de traiter le formulaire de modification du profil
    #[Route('/account/profile', name: 'app_account_profile')]
    #[IsGranted('ROLE_USER')]
    public function profile(Request $request, EntityManagerInterface $manager): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(AccountType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->persist($user);
            $manager->flush();

            $this->addFlash(
                'success',
                "Les données du profil ont été enregitrée avec succés"
            );
        }
        return $this->render('account/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #Permet d'afficherle profil de l'utilisateur connecter
    #[Route('/account', name: 'app_account_index')]
    #[IsGranted('ROLE_USER')]
    public function myAccount(){
        return $this->render('account/user.html.twig', [
            'user' => $this->getUser()
        ]);
    }

    #Function qui devrait m'afficher tous les utilisateurs de N3web
    #[Route('/account/n3web', name: 'app_account_n3web')]
    #[IsGranted('ROLE_USER')]
    public function listNeweb(UserRepository $userRepository){
        return $this->render('account/list_neweb.html.twig', [
            'users' => $userRepository->findAll(),
            'user' => $this->getUser()
        ]);
    }
}

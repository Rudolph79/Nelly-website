<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AccountPasswordController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    /**
     * @Route("/compte/modifier-mon-mot-de-passe", name="app_account_password")
     */
    public function index(Request $request, UserPasswordHasherInterface $encode): Response
    {
        $notification = null;

        /** @var User */
        $user = $this->getUser();
        $form = $this->createForm(ChangePasswordType::class, $user);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $old_password = $form->get('old_password')->getData();
            
            if ($encode->isPasswordValid($user, $old_password)) {
                $new_password = $form->get('new_password')->getData();
                $password = $encode->hashPassword($user, $new_password);

                $user->setPassword($password);

                // $this->entityManager->persist($user);
                $this->entityManager->flush();
                $notification = "Votre mot de passe a bien été mis à jour";
            } else {
                $notification = "Votre mot de passe actuel n'est pas le bon.";
            }
        }

        return $this->render('account/modification-mot-de-passe.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification
        ]);
    }
}

<?php

namespace App\Controller\BackOffice;

use Exception;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[IsGranted('ROLE_ADMIN')]
class UserController extends AbstractController
{
    #[Route('/user', name: 'user_index', methods: ['GET'])]
    public function index(UserRepository $user): Response
    {
        return $this->render('admin/user/index.html.twig', [
            'users' => $user->findAll(),
        ]);
    }
    
    #[Route('/user/edit/{id}', name: 'user_edit', requirements: ['id' => '^\d+$'], methods: ['GET', 'POST'])]
    public function edit(User $user, Request $request): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $role = $form->getData()->getRoles();
            if (in_array('ROLE_ADMIN',$role)) {
                $user->setRoles(['ROLE_ADMIN']);
            }else if(in_array('ROLE_MANAGER',$role)) {
                $user->setRoles(['ROLE_MANAGER']);
            }
            $em->flush();

            $this->addFlash('green', "L'utilisateur {$user->getEmail()} à bien été édité.");

            return $this->redirectToRoute('user_index');
        }

        return $this->render('admin/user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView()
        ]);
    }

    #[Route('/user/delete/{id}/{token}', name: 'user_delete', requirements: ['id' => '^\d+$'], methods: ['GET'])]
    public function delete(User $user, $token): Response
    {
        if ($this->isCsrfTokenValid('delete_user', $token)) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();

            $this->addFlash('red', "L'utilisateur {$user->getNom()} à bien été supprimé.");

            return $this->redirectToRoute('user_index');
        }

        throw new Exception('Invalid token  !!!');
    }

}

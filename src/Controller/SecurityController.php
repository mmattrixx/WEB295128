<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{


    /**
     * @Route("/login", name="security_login")
     */
    public function login(
        Request $request,
        AuthenticationUtils $authenticationUtils)
    {
        return $this->render(  'users/login.html.twig',
        [
            'last_username' => $authenticationUtils->getLastUsername(),
            'error' => $authenticationUtils->getLastAuthenticationError(),

        ]
    );

    }

    /**
     * @Route("/logout", name="security_logout")
     */
    public function logout()
    {

    }
    /**
     * @Route("/ListUser" , name="users_list")
     */
    public function ListUsers(Security $security)
    {
        $this->denyAccessUnlessGranted(User::ROLE_ADMIN);
        $users=$this->getDoctrine()->getRepository(User::class)->findAll();
        return $this->render(  'users/UsersList.html.twig',
            [
                'users'=>$users

            ]
        );


    }
    /**
     * @Route("/EditUser/{id}" , name="user_edit")
     */
    public function EditUser(Security $security,$id,Request $request,UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->denyAccessUnlessGranted(User::ROLE_ADMIN);
        $users=$this->getDoctrine()->getRepository(User::class)->find($id);
        $submittedToken = $request->request->get('token');

        // 'delete-item' is the same value used in the template to generate the token
        if ($this->isCsrfTokenValid('edit-user', $submittedToken)) {
            $users->setRoles([$request->request->get('role')]);
            $users->setFullName($request->request->get('fullname'));
            $users->setUsername($request->request->get('username'));
            $users->setEmail($request->request->get('email'));
            if($request->request->get('password')!=""){
                $password=$passwordEncoder->encodePassword($users,$request->get('password'));
                $users->setPassword($password);
            }
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($users);
            $entityManager->flush();
            return $this->redirectToRoute('users_list');
        }
        else
        return $this->render(  'users/EditUser.html.twig',
            [
                'users'=>$users,
                'oper'=>'edit'

            ]
        );
    }


    /**
     * @Route("/NewUser" , name="new_user")
     */
    public function NewUser(Security $security,Request $request,UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->denyAccessUnlessGranted(User::ROLE_ADMIN);
        $users=new User();
        $submittedToken = $request->request->get('token');

        // 'delete-item' is the same value used in the template to generate the token
        if ($this->isCsrfTokenValid('edit-user', $submittedToken)) {
            $users->setRoles([$request->request->get('role')]);
            $users->setFullName($request->request->get('fullname'));
            $users->setUsername($request->request->get('username'));
            $users->setEmail($request->request->get('email'));
            if($request->request->get('password')!=""){
                $password=$passwordEncoder->encodePassword($users,$request->get('password'));
                $users->setPassword($password);
            }
            $entityManager=$this->getDoctrine()->getManager();
            $entityManager->persist($users);
            $entityManager->flush();
            return $this->redirectToRoute('users_list');
        }
        else
            return $this->render(  'users/EditUser.html.twig',
                [
                    'users'=>$users,
                    'oper'=>'new'

                ]
            );


    }

}
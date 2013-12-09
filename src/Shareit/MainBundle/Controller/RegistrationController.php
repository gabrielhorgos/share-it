<?php

namespace Shareit\MainBundle\Controller;

use Shareit\MainBundle\Form\ProfileType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use Symfony\Component\Security\Core\SecurityContext;
use Shareit\MainBundle\Entity\User;
use Shareit\MainBundle\Form\UserType;

class RegistrationController extends Controller
{
    public function registerAction(Request $request)
    {
        if ($this->get('security.context')->isGranted('ROLE_USER')) {
            return $this->redirect($this->generateUrl('homepage'));
        }
        $user = new User();
        $form = $this->createForm(new UserType(), $user);

        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $userManager = $this->container->get('shareit.user_manager');
                $em = $this->getDoctrine()->getManager();
                $userManager->updatePassword($user);
                $user->getProfile()->setUser($user);
                if ($file = $request->files->get('user')) {
                    $filename = $userManager->handleFileUpload($file['profile']['file'], 'users/');
                    $user->getProfile()->setPhoto($filename);
                    $user->getProfile()->setFile(null);
                }
                $em->persist($user);
                $em->flush();

                //authenticate user
                $token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
                $this->container->get('security.context')->setToken($token);

                return $this->redirect($this->generateUrl('homepage'));
            }
        }

        return $this->render('ShareitMainBundle:Registration:registration.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function loginAction(Request $request)
    {

        if (!$this->get('security.context')->isGranted('ROLE_USER')) {
            $session = $this->get('session');
            if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
                $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);

            } else {
                $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
                $session->remove(SecurityContext::AUTHENTICATION_ERROR);
            }

            return $this->render('ShareitMainBundle:Homepage:login.html.twig', array(
                'error' => $error,
            ));
        }
        return $this->redirect($this->generateUrl('homepage'));
    }

    public function myAccountAction(Request $request)
    {
        if ($user = $this->getUser()) {

            $form = $this->createForm(new ProfileType(), $user->getProfile());
            if ($request->getMethod() == 'POST') {
                $form->bind($request);
                if ($file = $request->files->get('profile')) {
                    $user->getProfile()->setFile('');
                }
                if ($form->isValid()) {
                    if ($file = $request->files->get('profile')) {
                        if ($file['file']) {
                            $filename = $this->container->get('shareit.user_manager')->handleFileUpload($file['file'], 'users/');
                            $user->getProfile()->setPhoto($filename);
                            $user->getProfile()->setFile(null);
                        }
                    }
                    $em = $this->getDoctrine()->getManager();
                    $em->flush();
                }
            }
            return $this->render('ShareitMainBundle:Registration:myaccount.html.twig', array(
                'user' => $user,
                'form' => $form->createView(),
            ));
        }

        throw new AccessDeniedException();
    }

    public function forgotPasswordAction(Request $request)
    {
        if ($request->getMethod() == "POST") {
            if ($email = $request->request->get('email')) {
                $user = $this->getDoctrine()->getRepository('ShareitMainBundle:User')->findOneByEmail($email);
                if ($user) {
                    $this->container->get('shareit.user_manager')->resetPassword($user);
                    return $this->redirect($this->generateUrl('fo_login'));
                }
            }
        }
        throw new AccessDeniedException();
    }
}

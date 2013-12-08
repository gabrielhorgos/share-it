<?php

namespace Shareit\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\HttpFoundation\Request;
use Shareit\MainBundle\Entity\User;
use Shareit\MainBundle\Form\UserType;

class RegistrationController extends Controller
{
    public function registerAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(new UserType(), $user);

        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $this->container->get('shareit.user_manager')->updatePassword($user);
                $user->getProfile()->setUser($user);

                $em->persist($user);
                $em->flush();

                //login user
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
}

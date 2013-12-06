<?php

namespace Shareit\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class RegistrationController extends Controller
{
    public function registerAction(Request $request)
    {
        return $this->render('ShareitMainBundle:Registration:registration.html.twig');
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

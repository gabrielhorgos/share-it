<?php

namespace Shareit\BackOfficeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\SecurityContext;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        $session = $this->get('session');

        if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
        } else {
            $error = $session->get(SecurityContext::AUTHENTICATION_ERROR);

            $session->remove(SecurityContext::AUTHENTICATION_ERROR);
        }

        return $this->render('ShareitBackOfficeBundle:Security:login.html.twig', array(
                'error' => $error)
        );
    }
}

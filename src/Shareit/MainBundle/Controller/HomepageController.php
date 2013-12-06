<?php

namespace Shareit\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class HomepageController extends Controller
{
    public function indexAction()
    {
        return $this->render('ShareitMainBundle:Homepage:homepage.html.twig');
    }

}

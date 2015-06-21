<?php

namespace Frexin\UwidgetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('FrexinUwidgetBundle:Default:index.html.twig', array('name' => $name));
    }
}

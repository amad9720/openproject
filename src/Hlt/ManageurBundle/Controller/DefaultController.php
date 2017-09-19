<?php

namespace Hlt\ManageurBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('HltManageurBundle:Default:index.html.twig');
    }
}

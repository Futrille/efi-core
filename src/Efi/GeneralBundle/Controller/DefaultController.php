<?php

namespace Efi\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EfiGeneralBundle:Default:index.html.twig');
    }
}

<?php

namespace Efi\GanadosBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('EfiGanadosBundle:Default:index.html.twig');
    }
}

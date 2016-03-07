<?php

namespace Efi\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SecurityController extends Controller
{
    public function loginAction()
    {
        return $this->render('EfiGeneralBundle:Security:login.html.twig', array(
            // ...
        ));
    }

    public function logoutAction()
    {
        return $this->render('EfiGeneralBundle:Security:logout.html.twig', array(
            // ...
        ));
    }

}

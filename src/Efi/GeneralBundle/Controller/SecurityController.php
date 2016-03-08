<?php

namespace Efi\GeneralBundle\Controller;

use Efi\GeneralBundle\EfiGeneralBundle as Util;

use Efi\GeneralBundle\Entity\Login;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Security\Csrf\CsrfTokenManager;

class SecurityController extends Controller
{
    private $util = null;

    public function loginAction(Request $request)
    {
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $this->util = new Util();
        $resultado = array();

        $resultado['status']        = 'logout';
        $resultado['message']       = 'Debe Iniciar Sesion';
        $resultado['response']      = array(
            'error' => $error,
            'lastUsername'  => $lastUsername
        );

//        $token_manager = new CsrfTokenManager();
//        $token = $token_manager->getToken("_token");
//        return $this->util->efiGetJsonResponse($token);
//        return $this->render('persona/new.html.twig', array(
//            'persona' => $persona,
//            'form' => $form->createView(),
//        ));
        return $this->util->efiGetJsonResponse($resultado);
    }

    public function logoutAction()
    {
        return $this->render('EfiGeneralBundle:Security:logout.html.twig', array(
            // ...
        ));
    }

}

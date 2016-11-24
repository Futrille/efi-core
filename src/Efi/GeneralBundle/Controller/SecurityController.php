<?php

namespace Efi\GeneralBundle\Controller;

use Efi\GeneralBundle\EfiGeneralBundle as Util;

use Efi\GeneralBundle\Entity\Login;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\Security\Csrf\CsrfTokenManager;
use AppBundle\GeneralResponse;

class SecurityController extends Controller
{
    private $util = null;

    public function loginAction(Request $request)
    {
        $response = new GeneralResponse();
        $authenticationUtils = $this->get('security.authentication_utils');

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $response->setStatus(GENERAL_RESPONSE_LOGOUT);
        $response->setMessage('logout');
        $response->setData(null);
        $response->addToMetaData('error', $error);
        $response->addToMetaData('lastUsername', $lastUsername);

//        return $this->render('security/login.html.twig', array(
//            'last_username' => $lastUsername,
//            'error'         => $error,
//            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
//        ));
        return $response->toJSON();
    }

    public function logoutAction()
    {
        $this->container->get('security.context')->setToken(null);

        return $this->redirect($this->generateUrl('login'));
//        return new Response('<html><body>Logout page!</body></html>');
    }

    public function adminAction()
    {
        return new Response('<html><body>ADMIN page!</body></html>');
    }

}

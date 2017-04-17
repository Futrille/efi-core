<?php

namespace Efi\GeneralBundle\Controller;

use Efi\GeneralBundle\Entity\Login;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use AppBundle\GeneralResponse;

class SecurityController extends Controller
{

    public function loginAction(Request $request)
    {
        $response = new GeneralResponse();
        $authenticationUtils = $this->get('security.authentication_utils');

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        $response->setStatus(GENERAL_RESPONSE_LOGOUT);
        $response->setMessage('logout');
        $response->setData(null);
        $response->addToMetaData('error', $error);
        $response->addToMetaData('lastUsername', $lastUsername);

        return $response->toJSON();
    }

    public function des(){
        $encoded = "...";   // <-- encoded string from the request
        $decoded = "";
        for( $i = 0; $i < strlen($encoded); $i++ ) {
            $b = ord($encoded[$i]);
            $a = $b ^ 123;  // <-- must be same number used to encode the character
            $decoded .= chr($a);
        }
        return $decoded;
    }

    public function logoutAction()
    {
        $this->container->get('security.context')->setToken(null);
        return $this->redirect($this->generateUrl('login'));
    }

    public function adminAction()
    {
        return new Response('<html><body>ADMIN page!</body></html>');
    }

}

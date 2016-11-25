<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\GeneralResponse;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $response = new GeneralResponse();

        $response->setData(null);
        $response->setStatus(GENERAL_RESPONSE_SUCCESS);
        $response->setMessage('login');

        return $response->toJSON();
    }
}

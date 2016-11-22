<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Efi\GeneralBundle\EfiGeneralBundle as Util;

class DefaultController extends Controller
{
    private $util = null;

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $this->util = new Util();
        $resultado = array();

        $resultado['status'] = "success";
        $resultado['message'] = "";
        $resultado['response'] = "";

//        return $this->util->efiGetJsonResponse($resultado);
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ));
    }
}

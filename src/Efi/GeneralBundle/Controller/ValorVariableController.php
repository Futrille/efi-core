<?php

namespace Efi\GeneralBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;

use Efi\GeneralBundle\EfiGeneralBundle as Util;

class ValorVariableController extends Controller
{
    private $util = null;

    public function indexAction()
    {
        $util = new Util();
        //$key = $request->query->get('key',0);
        $vvaList = $this->getDoctrine()
            ->getRepository('EfiGeneralBundle:ValorVariable')
            ->findAll();

        $response = new JsonResponse();
        $response->setContent($util->getSerialize($vvaList));
        return $response;
    }
}
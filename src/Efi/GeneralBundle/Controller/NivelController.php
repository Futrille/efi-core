<?php

namespace Efi\GeneralBundle\Controller;

use Efi\GeneralBundle\EfiGeneralBundle as Util;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Efi\GeneralBundle\Entity\Nivel;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Nivel controller.
 *
 * @Route("/nivel")
 */
class NivelController extends Controller
{
    /**
     * Lists all Nivel entities.
     *
     */
    public function indexAction()
    {
        $util = new Util();
        //$key = $request->query->get('key',0);
        $nivels = $this->getDoctrine()
            ->getRepository('EfiGeneralBundle:Nivel')
            ->findAll();

        $response = new JsonResponse();
        $response->setContent($util->getSerialize($nivels));
        return $response;
    }

    /**
     * Finds and displays a Nivel entity.
     *
     */
    public function showAction(Nivel $nivel)
    {

        return $this->render('nivel/show.html.twig', array(
            'nivel' => $nivel,
        ));
    }
}

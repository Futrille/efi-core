<?php

namespace Efi\GanadosBundle\Controller;

use Proxies\__CG__\Efi\GeneralBundle\Entity\ValorVariable;
use Symfony\Component\BrowserKit\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Efi\GeneralBundle\EfiGeneralBundle as Util;

use Symfony\Component\HttpFoundation\JsonResponse;
use Efi\GanadosBundle\Entity\Persona;
use Efi\GanadosBundle\Form\PersonaType;

/**
 * Persona controller.
 *
 */
class PersonaController extends Controller
{
    private $util = null;

    /**
     * Lists all Persona entities.
     *
     */
    public function indexAction()
    {
        $util = new Util();
        //$key = $request->query->get('key',0);
        $vvaList = $this->getDoctrine()
            ->getRepository('EfiGanadosBundle:Persona')
            ->findAll();

        $response = new JsonResponse();
        $response->setContent($util->getSerialize($vvaList));
        return $response;
//        $em = $this->getDoctrine()->getManager();
//
//        $personas = $em->getRepository('EfiGanadosBundle:Persona')->findAll();
//
//        return $this->render('persona/index.html.twig', array(
//            'personas' => $personas,
//        ));
    }

    /**
     * Creates a new Persona entity.
     *
     */
    public function newAction(Request $request)
    {
        $estatusDefault = 2;
        $esCompletoDefault = 1;

        $persona = new Persona();
        $form = $this->createForm('Efi\GanadosBundle\Form\PersonaType', $persona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $persona->setEstatus($estatusDefault);
            $idEstatus = $this->getDoctrine()
                ->getRepository('EfiGeneralBundle:ValorVariable')
                ->findOneBy(
                    array('codigo' => 'per_estatus', 'valor' => $estatusDefault)
                );
            $persona->setIdEstatus($idEstatus);

            //Verificando que esté completo el registro
            if ($persona->getCedula() == null || $persona->getCedula() == ''){
                $esCompletoDefault = 0;
            }

            $persona->setEsCompleto($esCompletoDefault);
            $idEsCompleto = $this->getDoctrine()
                ->getRepository('EfiGeneralBundle:ValorVariable')
                ->findOneBy(
                    array('codigo' => 'bool', 'valor' => $esCompletoDefault)
                );
            $persona->setIdEsCompleto($idEsCompleto);

            $em->persist($persona);
            $em->flush();

            return $this->redirectToRoute('persona_show', array('id' => $persona->getId()));
        }

        return $this->render('persona/new.html.twig', array(
            'persona' => $persona,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Persona entity.
     *
     */
    public function showAction(Persona $persona)
    {
        $deleteForm = $this->createDeleteForm($persona);

        return $this->render('persona/show.html.twig', array(
            'persona' => $persona,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Persona entity.
     *
     */
    public function editAction(Request $request, Persona $persona)
    {
        $util = new Util();
        $estatusDefault = 2;
        $esCompletoDefault = 1;

        $deleteForm = $this->createDeleteForm($persona);
        $editForm = $this->createForm('Efi\GanadosBundle\Form\PersonaType', $persona);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $persona->setEstatus($estatusDefault);
            $idEstatus = $this->getDoctrine()
                ->getRepository('EfiGeneralBundle:ValorVariable')
                ->findOneBy(
                    array('codigo' => 'per_estatus', 'valor' => $estatusDefault)
                );
            $persona->setIdEstatus($idEstatus);

            //Verificando que esté completo el registro
            if ($persona->getCedula() == null || $persona->getCedula() == ''){
                $esCompletoDefault = 0;
            }

            $persona->setEsCompleto($esCompletoDefault);
            $idEsCompleto = $this->getDoctrine()
                ->getRepository('EfiGeneralBundle:ValorVariable')
                ->findOneBy(
                    array('codigo' => 'bool', 'valor' => $esCompletoDefault)
                );
            $persona->setIdEsCompleto($idEsCompleto);


            $em->persist($persona);
            $em->flush();

            $response = new JsonResponse();
            $response->setContent($util->getSerialize($persona));
            return $response;

            return $this->redirectToRoute('persona_edit', array('id' => $persona->getId()));
        }

        return $this->render('persona/edit.html.twig', array(
            'persona' => $persona,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Persona entity.
     *
     */
    public function deleteAction(Request $request, Persona $persona)
    {
        $form = $this->createDeleteForm($persona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($persona);
            $em->flush();
        }

        return $this->redirectToRoute('persona_index');
    }

    /**
     * Creates a form to delete a Persona entity.
     *
     * @param Persona $persona The Persona entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Persona $persona)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('persona_delete', array('id' => $persona->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

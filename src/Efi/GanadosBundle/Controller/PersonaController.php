<?php

namespace Efi\GanadosBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Efi\GeneralBundle\EfiGeneralBundle as Util;

use Efi\GanadosBundle\Entity\Persona as Persona;
use Efi\GeneralBundle\Entity\Pais as Pais;
use Efi\GeneralBundle\Entity\ValorVariable as ValorVariable;
use Efi\GeneralBundle\Entity\Iglesia as Iglesia;
use Efi\GanadosBundle\Form\PersonaType as PersonaType;

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

        return $util->efiGetJsonResponse($vvaList);
    }

    /**
     * Creates a new Persona entity.
     *
     */
    public function newAction(Request $request)
    {
        $util = new Util();

        $persona = new Persona();
        $form = $this->createForm('Efi\GanadosBundle\Form\PersonaType', $persona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            echo "control...";
            $em = $this->getDoctrine()->getManager();

            $this->_setValoresDefault($persona);

            $em->persist($persona);
            $em->flush();

            return $util->efiGetJsonResponse($persona);
            //return $this->redirectToRoute('persona_show', array('id' => $persona->getId()));
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

        $deleteForm = $this->createDeleteForm($persona);
        $editForm = $this->createForm('Efi\GanadosBundle\Form\PersonaType', $persona);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $this->_setValoresDefault($persona);

            $em->persist($persona);
            $em->flush();

            return $util->efiGetJsonResponse($persona);
            //return $this->redirectToRoute('persona_edit', array('id' => $persona->getId()));
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

    /**
     * @param Persona $persona
     */
    private function _setValoresDefault(Persona $persona){

        $estatusDefault = 1;
        $esCompletoDefault = 1;
        $paisDefault = 1;
        $iglesiaDefault = 1;

        $persona->setEstatus($estatusDefault);
        $idEstatus = $this->getDoctrine()
            ->getRepository('EfiGeneralBundle:ValorVariable')
            ->findOneBy(
                array('codigo' => 'per_estatus', 'valor' => $estatusDefault)
            );
        /** @var ValorVariable $idEstatus */
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
        /** @var ValorVariable $idEsCompleto */
        $persona->setIdEsCompleto($idEsCompleto);

        $pais = $this->getDoctrine()
            ->getRepository('EfiGeneralBundle:Pais')
            ->find($paisDefault);
        /** @var Pais $pais */
        $persona->setPais($pais);

        $iglesia = $this->getDoctrine()
            ->getRepository('EfiGeneralBundle:Iglesia')
            ->find($iglesiaDefault);
        /** @var Iglesia $iglesia */
        $persona->setIglesia($iglesia);
    }
}

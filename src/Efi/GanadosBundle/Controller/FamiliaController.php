<?php

namespace Efi\GanadosBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Efi\GeneralBundle\EfiGeneralBundle as Util;
use AppBundle\Response;

use Efi\GanadosBundle\Entity\Familia;
use Efi\GanadosBundle\Form\FamiliaType;
use Doctrine\ORM\Query\ResultSetMapping;

/**
 * Familia controller.
 *
 */
class FamiliaController extends Controller
{
    /**
     * Lists all Familia entities.
     *
     */
    public function indexAction()
    {
        $response = new Response();
        $this->util = new Util();
        $resultado = $this->util->createResponseObject();

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            "SELECT FAM.id, FAM.nombre, COUNT(PER.familia) AS integrantes "
            ."FROM EfiGanadosBundle:Familia FAM " 
            ."    INNER JOIN EfiGanadosBundle:Persona PER WITH FAM.id = PER.familia "
            ."GROUP BY FAM.id"
            );

        $resultado['response']['data'] = $query->getResult();
        $resultado['response']['count'] = count($resultado['response']['data']);
        return $this->util->efiGetJsonResponse($resultado);
    }

    /**
     * Creates a new Familia entity.
     *
     */
    public function newAction(Request $request)
    {
        $familium = new Familia();
        $form = $this->createForm('Efi\GanadosBundle\Form\FamiliaType', $familium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($familium);
            $em->flush();

            return $this->redirectToRoute('familia_show', array('id' => $familium->getId()));
        }

        return $this->render('familia/new.html.twig', array(
            'familium' => $familium,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Familia entity.
     *
     */
    public function showAction(Familia $familium)
    {
        $deleteForm = $this->createDeleteForm($familium);

        return $this->render('familia/show.html.twig', array(
            'familium' => $familium,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Familia entity.
     *
     */
    public function editAction(Request $request, Familia $familium)
    {
        $deleteForm = $this->createDeleteForm($familium);
        $editForm = $this->createForm('Efi\GanadosBundle\Form\FamiliaType', $familium);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($familium);
            $em->flush();

            return $this->redirectToRoute('familia_edit', array('id' => $familium->getId()));
        }

        return $this->render('familia/edit.html.twig', array(
            'familium' => $familium,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Familia entity.
     *
     */
    public function deleteAction(Request $request, Familia $familium)
    {
        $form = $this->createDeleteForm($familium);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($familium);
            $em->flush();
        }

        return $this->redirectToRoute('familia_index');
    }

    /**
     * Creates a form to delete a Familia entity.
     *
     * @param Familia $familium The Familia entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Familia $familium)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('familia_delete', array('id' => $familium->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
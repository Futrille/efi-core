<?php

namespace Efi\GeneralBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Efi\GeneralBundle\EfiGeneralBundle as Util;

use Symfony\Component\HttpFoundation\JsonResponse;
use Efi\GeneralBundle\Entity\ValorVariable;
use Efi\GeneralBundle\Form\ValorVariableType;

/**
 * ValorVariable controller.
 *
 */
class ValorVariableController extends Controller
{
    /**
     * Lists all ValorVariable entities.
     *
     */
    public function indexAction(Request $request)
    {
        $util = new Util();

        if($request->headers->get('vvaCodigo')!=null){
            $vvaList = $this->getDoctrine()
                ->getRepository('EfiGeneralBundle:ValorVariable')
                ->findBy(array('codigo' => $request->headers->get('vvaCodigo')));
        }else {
            $vvaList = $this->getDoctrine()
                ->getRepository('EfiGeneralBundle:ValorVariable')
                ->findAll();
        }
        //$key = $request->query->get('key',0);


        $response = new JsonResponse();
        $response->setContent($util->getSerialize($vvaList));
        return $response;
//        $em = $this->getDoctrine()->getManager();
//
//        $valorVariables = $em->getRepository('EfiGeneralBundle:ValorVariable')->findAll();
//
//        return $this->render('valorvariable/index.html.twig', array(
//            'valorVariables' => $valorVariables,
//        ));
    }

    /**
     * Creates a new ValorVariable entity.
     *
     */
    public function newAction(Request $request)
    {
        $valorVariable = new ValorVariable();
        $form = $this->createForm(ValorVariableType::class, $valorVariable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($valorVariable);
            $em->flush();

            return $this->redirectToRoute('valorvariable_show', array('id' => $valorVariable->getId()));
        }

        return $this->render('valorvariable/new.html.twig', array(
            'valorVariable' => $valorVariable,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a ValorVariable entity.
     *
     */
    public function showAction(ValorVariable $valorVariable)
    {
        $deleteForm = $this->createDeleteForm($valorVariable);

        return $this->render('valorvariable/show.html.twig', array(
            'valorVariable' => $valorVariable,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing ValorVariable entity.
     *
     */
    public function editAction(Request $request, ValorVariable $valorVariable)
    {
        $deleteForm = $this->createDeleteForm($valorVariable);
        $editForm = $this->createForm(ValorVariableType::class, $valorVariable);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($valorVariable);
            $em->flush();

            return $this->redirectToRoute('valorvariable_edit', array('id' => $valorVariable->getId()));
        }

        return $this->render('valorvariable/edit.html.twig', array(
            'valorVariable' => $valorVariable,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a ValorVariable entity.
     *
     */
    public function deleteAction(Request $request, ValorVariable $valorVariable)
    {
        $form = $this->createDeleteForm($valorVariable);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($valorVariable);
            $em->flush();
        }

        return $this->redirectToRoute('valorvariable_index');
    }

    /**
     * Creates a form to delete a ValorVariable entity.
     *
     * @param ValorVariable $valorVariable The ValorVariable entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ValorVariable $valorVariable)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('valorvariable_delete', array('id' => $valorVariable->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

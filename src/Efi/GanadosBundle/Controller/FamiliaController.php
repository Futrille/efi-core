<?php

namespace Efi\GanadosBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Efi\GeneralBundle\EfiGeneralBundle as Util;
use AppBundle\GeneralResponse;

use Efi\GanadosBundle\Entity\Familia;
use Efi\GanadosBundle\Form\FamiliaType;
use Doctrine\ORM\Query\ResultSetMapping;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Response;

/**
 * Familia controller.
 *
 */
class FamiliaController extends Controller
{
    /**
     * Listado de Familias. Filtradas por Pareja Ministerial (Codigo).
     * Adem&aacute;s muestra los integrantes en cada una de ellas.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Listado resumen de Familias conectadas.",
     *  views = {"all", "ganados"}
     * )
     */
    public function indexAction(Request $request)
    {
        $response = new GeneralResponse();

        /**
         * Aqui se obtendrá desde el request el valor del Usuario conectado
         * y luego se obtendrá su CodigoPMI
         *
         * Falta Agregar el estaus de la persona en este momento, es decir el que esta recien cargado.
         */

        //Por ahora el codigoParejaMinisterial será enviado desde la vista
        $codigo = $request->get('codigoPmi');
        $_format = $request->get('_format', 'html');

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            "SELECT FAM.id, FAM.nombre, COUNT(PER.familia) AS integrantes "
            ."FROM EfiGanadosBundle:Familia FAM " 
            ."    LEFT JOIN EfiGanadosBundle:Persona PER WITH FAM.id = PER.familia "
            ."WHERE PER.codigoParejaMinisterial = :codigoPmi "
            ."GROUP BY FAM.id")
            ->setParameter('codigoPmi', $codigo);

        if ($_format != null && $_format == 'json') {
            $response->setData($query->getResult());
            $response->addToMetaData('count', count($response->getData()));
            $response->addToMetaData('codigo', $codigo);
            return $response->toJSON();
        }
        return new Response('<html><head></head><body></body></html>');
    }

    /**
     * Nueva Familia
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Datos de Formulario para nueva familia",
     *  views = {"all", "ganados"}
     * )
     */
    public function newAction(Request $request)
    {
        $familia = new Familia();
        $form = $this->createForm('Efi\GanadosBundle\Form\FamiliaType', $familia);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($familia);
            $em->flush();

            return $this->redirectToRoute('familia_show', array('id' => $familia->getId()));
        }

        return $this->render('familia/new.html.twig', array(
            'familia' => $familia,
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

<?php

namespace Efi\GeneralBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Efi\GeneralBundle\Entity\Iglesia;
use Efi\GeneralBundle\Form\IglesiaType;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use AppBundle\GeneralResponse;

/**
 * Iglesia controller.
 *
 */
class IglesiaController extends Controller
{
    /**
     * Listado de Iglesias. Retorna el listado de todas las iglesias registradas en el sistema
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Listado de iglesias registradas.",
     *  views = {"all", "iglesias"}
     * )
     */
    public function indexAction()
    {
        $response = new GeneralResponse();
        $repo = $this->getDoctrine()->getRepository('EfiGeneralBundle:Iglesia');

        $lista = $repo->findAll();
        if ($lista != null){
            $response->setData($lista);
        }

        return $response->toJSON();
    }
    /**
     * Action de prueba con multiples Methods
     *
     * @ApiDoc(
     *  resource=true,
     *  description="",
     *  views = {"all", "iglesias"}
     * )
     */
    public function restAction(Request $request)
    {
        $response = new GeneralResponse();
        $repo = $this->getDoctrine()->getRepository('EfiGeneralBundle:Iglesia');

        $idEntidad = $request->get('id');
        $data = null;
        switch($request->getMethod()){
            case "GET":
                if ($idEntidad == 0){
                    $data = $repo->findAll();
                }
                else{
                    $data = $repo->findOneById($idEntidad);
                }
                break;
            case "POST":
                $iglesia = new Iglesia();
                $form = $this->createForm(IglesiaType::class, $iglesia);
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    $data = 'data guardada por submit...';
//                    $em = $this->getDoctrine()->getManager();
//                    $em->persist($familia);
//                    $em->flush();
//
//                    return $this->redirectToRoute('familia_show', array('id' => $familia->getId()));
                }
                $data = $this->render('iglesia/new.html.twig', array(
                    'iglesia' => $iglesia,
                    'form' => $form->createView(),
                ))->getContent();
                break;
            case "PUT":

                break;
            case "DELETE":

                break;
        }
        $response->setData($data);


        return $response->toJSON();
    }

//    /**
//     * Creates a new Iglesia entity.
//     *
//     */
//    public function newAction(Request $request)
//    {
//        $iglesium = new Iglesia();
//        $form = $this->createForm('Efi\GeneralBundle\Form\IglesiaType', $iglesium);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($iglesium);
//            $em->flush();
//
//            return $this->redirectToRoute('iglesia_show', array('id' => $iglesia->getId()));
//        }
//
//        return $this->render('iglesia/new.html.twig', array(
//            'iglesium' => $iglesium,
//            'form' => $form->createView(),
//        ));
//    }
//
//    /**
//     * Finds and displays a Iglesia entity.
//     *
//     */
//    public function showAction(Iglesia $iglesium)
//    {
//        $deleteForm = $this->createDeleteForm($iglesium);
//
//        return $this->render('iglesia/show.html.twig', array(
//            'iglesium' => $iglesium,
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }
//
//    /**
//     * Displays a form to edit an existing Iglesia entity.
//     *
//     */
//    public function editAction(Request $request, Iglesia $iglesium)
//    {
//        $deleteForm = $this->createDeleteForm($iglesium);
//        $editForm = $this->createForm('Efi\GeneralBundle\Form\IglesiaType', $iglesium);
//        $editForm->handleRequest($request);
//
//        if ($editForm->isSubmitted() && $editForm->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($iglesium);
//            $em->flush();
//
//            return $this->redirectToRoute('iglesia_edit', array('id' => $iglesium->getId()));
//        }
//
//        return $this->render('iglesia/edit.html.twig', array(
//            'iglesium' => $iglesium,
//            'edit_form' => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
//        ));
//    }
//
//    /**
//     * Deletes a Iglesia entity.
//     *
//     */
//    public function deleteAction(Request $request, Iglesia $iglesium)
//    {
//        $form = $this->createDeleteForm($iglesium);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->remove($iglesium);
//            $em->flush();
//        }
//
//        return $this->redirectToRoute('iglesia_index');
//    }
//
//    /**
//     * Creates a form to delete a Iglesia entity.
//     *
//     * @param Iglesia $iglesium The Iglesia entity
//     *
//     * @return \Symfony\Component\Form\Form The form
//     */
//    private function createDeleteForm(Iglesia $iglesium)
//    {
//        return $this->createFormBuilder()
//            ->setAction($this->generateUrl('iglesia_delete', array('id' => $iglesium->getId())))
//            ->setMethod('DELETE')
//            ->getForm()
//        ;
//    }
}

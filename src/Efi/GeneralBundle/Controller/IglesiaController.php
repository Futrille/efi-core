<?php

namespace Efi\GeneralBundle\Controller;

use Efi\GeneralBundle\Entity\ValorVariable;
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
        $message = null;
        switch($request->getMethod()){
            case "GET":
                if ($idEntidad == 0){
                    $data = $this->getDoctrine()
                        ->getRepository('EfiGeneralBundle:Iglesia')
                        ->findBy(
                            array(
                                'estatus' => Iglesia::ESTATUS_ACTIVA
                            )
                        );
                }
                else{
                    $data = $repo->findOneById($idEntidad);
                }
                break;
            case "POST":
                if ($idEntidad == 0){
                    $iglesia = new Iglesia();
                }
                else{
                    $iglesia = $this->getDoctrine()
                        ->getRepository('EfiGeneralBundle:Iglesia')
                        ->findOneBy(
                            array(
                                'id' => $idEntidad
                            )
                        );
                }
                $form = $this->createForm(IglesiaType::class, $iglesia);
                $form->handleRequest($request);

                $response->setStatus(GENERAL_RESPONSE_ERROR);
                if ($form->isSubmitted() && $form->isValid()) {
                    if ($this->validarPersonalizado($iglesia)->getStatus() == GENERAL_RESPONSE_SUCCESS){
                        $this->_setValoresDefault($iglesia);

                        $em = $this->getDoctrine()->getManager();
                        $em->persist($iglesia);
                        $em->flush();

                        $response->setMessage('Registro guardado satisfactoriamente.');
                        $response->setStatus(GENERAL_RESPONSE_SUCCESS);
                    }
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

    /**
     * Valida que el registro no tenga Cedula o Correo repetidos
     * @param Persona $persona
     */
    private function validarPersonalizado(Iglesia $objeto){
        $response = new GeneralResponse();
        $id = $objeto->getId() == null ? 0 : $objeto->getId();

        $objectTest = null;
        
        return $response;
    }

    /**
     * @param Iglesia $objeto
     */
    private function _setValoresDefault(Iglesia $objeto){
        $estatusDefault = new ValorVariable();

        if ($objeto->getId() == null || ($objeto->getId() != null && $objeto->getId() < 1 )){
            $estatusDefault = $this->getValorVariableDefault('igl_estatus');
            $objeto->setIdEstatus($estatusDefault);
            $objeto->setEstatus($estatusDefault->getValor());

//            $objeto->setUpdatedAt(new \DateTime('now'));
//
//            if ($objeto->getCreatedAt() == null) {
//                $objeto->setCreatedAt(new \DateTime('now'));
//            }
        }
    }

    /**
     * @param $codigo
     * @param $valor
     * @return object ValorVariable
     */
    public function getValorVariableDefault($codigo){
        return $this->getDoctrine()
            ->getRepository('EfiGeneralBundle:ValorVariable')
            ->findOneBy(
                array(
                    'codigo' => $codigo,
                    'orden' => 1
                )
            );
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

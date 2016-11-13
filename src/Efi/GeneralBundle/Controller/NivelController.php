<?php

namespace Efi\GeneralBundle\Controller;

use AppBundle\GeneralResponse;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Efi\GeneralBundle\Entity\Nivel;
use Efi\GeneralBundle\Form\NivelType;
use Symfony\Component\HttpFoundation\Response;

/**
 * Nivel controller.
 *
 * @Route("/nivel")
 */
class NivelController extends Controller
{
    /**
     * Listado de Familias. Filtradas por Pareja Ministerial (Codigo).
     * Adem&aacute;s muestra los integrantes en cada una de ellas.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Listado resumen de Familias conectadas."
     * )
     */
    public function indexAction(Request $request)
    {
//        $em = $this->getDoctrine()->getManager();
//        $nivels = $em->getRepository('EfiGeneralBundle:Nivel')->findAll();
//
//        return $this->render('nivel/index.html.twig', array(
//            'nivels' => $nivels,
//        ));

        $em = $this->getDoctrine()->getManager();
        $result = array();

        if($request->headers->get("idNivel")!=null){
            $result = $em->getRepository('EfiGeneralBundle:Nivel')->findBy(array("id" => $request->headers->get("idNivel")));
        }else{
            $nivels = $em->getRepository('EfiGeneralBundle:Nivel')->findBy(array("padre" => null),array('orden' => 'ASC'));
            foreach ($nivels as &$valor) {
                array_push($result, $valor);

                $subNivels = $em->getRepository('EfiGeneralBundle:Nivel')->findBy(array("padre" => $valor->getId()),array('orden' => 'ASC'));
                foreach ($subNivels as &$subValor) {
                    array_push($result, $subValor);
                }
            }
        }



        $response = new GeneralResponse();
        $codigo = $request->get('codigoPmi');


        $response->setData($result);
        $response->addToMetaData('codigo', $codigo);

        return $response->toJSON();
    }

    /**
     * Insercion de nivles.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Insercion de niveles."
     * )
     */
    public function newAction(Request $request)
    {
//        $nivel = new Nivel();
//        $form = $this->createForm('Efi\GeneralBundle\Form\NivelType', $nivel);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->persist($nivel);
//            $em->flush();
//
//            return $this->redirectToRoute('nivel_show', array('id' => $nivel->getId()));
//        }
//
//        return $this->render('nivel/new.html.twig', array(
//            'nivel' => $nivel,
//            'form' => $form->createView(),
//        ));
        $em = $this->getDoctrine()->getManager();
        $data = new Nivel();
        $data->setIglesia(1);
        $data->setColor($request->headers->get('color'));
        $data->setNombre($request->headers->get('nombre'));

        //todo mandar desde la vista el id del padre de otro modo se debe cambiar este metodo
        if($request->headers->get('nivelPadre')=="null"){
            $data->setPadre(null);
            $padres  = $em->getRepository('EfiGeneralBundle:Nivel')->findBy(array("padre" => null));
            if($padres==null){
                $data->setOrden(1);
            }else{
                $data->setOrden(count($padres)+1);
            }
        }else{
            //$data->setPadre($request->headers->get('nivelPadre'));
            $data->setPadre($em->getRepository('EfiGeneralBundle:Nivel')->findOneBy(array("id" => $request->headers->get('nivelPadre'))));
            $hijos = $em->getRepository('EfiGeneralBundle:Nivel')->findBy(array("padre" => $request->headers->get('nivelPadre')));
            if($hijos==null){
                $data->setOrden(1);
            }else{
                $data->setOrden(count($hijos)+1);
            }
        }

        $data->setIdIcono($em->getRepository('EfiGeneralBundle:ValorVariable')->findOneBy(array("nombre" => $request->headers->get('icono'),'codigo' => 'nivel_icono')));
        $data->setIcono(1);

        $data->setIdTipo($em->getRepository('EfiGeneralBundle:ValorVariable')->findOneBy(array("nombre" => $request->headers->get('tipo'),'codigo' => 'nivel_tipo')));
        $data->setTipo(1);

        $data->setIdEstatus($em->getRepository('EfiGeneralBundle:ValorVariable')->findOneBy(array("nombre" => $request->headers->get('estatus'),'codigo' => 'nivel_estatus')));
        $data->setEstatus(1);

        $em->persist($data);
        $em->flush();

        $response = new GeneralResponse();
        $codigo = $request->get('codigoPmi');

        $response->setData("nivel creado exitosamente");
        $response->addToMetaData('codigo', $codigo);

        return $response->toJSON();
    }

    /**
     * Finds and displays a Nivel entity.
     *
     * @Route("/{id}", name="nivel_show")
     * @Method("GET")
     */
    public function showAction(Nivel $nivel)
    {
        $deleteForm = $this->createDeleteForm($nivel);

        return $this->render('nivel/show.html.twig', array(
            'nivel' => $nivel,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edicion de nivles.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Edicion de niveles."
     * )
     */
    public function editAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $nivel = $em->getRepository('EfiGeneralBundle:Nivel')->findOneBy(array("id" => $request->headers->get('id')));

        if($request->headers->get('orientation')=="up"){
            if($nivel->getPadre()!=null){
                $nivelToChange = $em->getRepository('EfiGeneralBundle:Nivel')->findOneBy(array("padre" => $nivel->getPadre(), 'orden'=>$nivel->getOrden()-1));
            }else{
                $nivelToChange = $em->getRepository('EfiGeneralBundle:Nivel')->findOneBy(array("padre" => null, 'orden'=>$nivel->getOrden()-1));
            }
        }else{
            if($nivel->getPadre()!=null){
                $nivelToChange = $em->getRepository('EfiGeneralBundle:Nivel')->findOneBy(array("padre" => $nivel->getPadre(), 'orden'=>$nivel->getOrden()+1));
            }else{
                $nivelToChange = $em->getRepository('EfiGeneralBundle:Nivel')->findOneBy(array("padre" => null, 'orden'=>$nivel->getOrden()+1));
            }
        }

        if($nivelToChange != null){
            $tempOrden=$nivel->getOrden();
            $nivel->setOrden($nivelToChange->getOrden());
            $nivelToChange->setOrden($tempOrden);

            $em->persist($nivel);
            $em->flush();

            $em->persist($nivelToChange);
            $em->flush();
        }

        $response = new GeneralResponse();
        $codigo = $request->get('codigoPmi');

        $response->setData("nivel cambiado exitosamente");
        $response->addToMetaData('codigo', $codigo);

        return $response->toJSON();
    }

    /**
     * Eliminacion de nivles.
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Eliminacion de niveles."
     * )
     */
    public function deleteAction(Request $request)
    {
//        $form = $this->createDeleteForm($nivel);
//        $form->handleRequest($request);
//
//        if ($form->isSubmitted() && $form->isValid()) {
//            $em = $this->getDoctrine()->getManager();
//            $em->remove($nivel);
//            $em->flush();
//        }
//
//        return $this->redirectToRoute('nivel_index');
        $em = $this->getDoctrine()->getManager();
        $nivel = $em->getRepository('EfiGeneralBundle:Nivel')->findOneBy(array("id" => $request->headers->get('id')));

        $subNivels = $em->getRepository('EfiGeneralBundle:Nivel')->findBy(array("padre" => $request->headers->get('id')));
        if($subNivels!=null){
            foreach ($subNivels as &$subValor) {
                $em->remove($subValor);
                $em->flush();
            }
        }

        $em->remove($nivel);
        $em->flush();

        //actualizamos el orden de los indices
        $contParentNull  = 0;
        $nivels = $em->getRepository('EfiGeneralBundle:Nivel')->findBy(array("padre" => null), array('orden' => 'ASC'));
        foreach ($nivels as &$valor) {
            $contParentNull++;
            $valor->setOrden($contParentNull);
            $em->persist($valor);
            $em->flush();

            $cont=0;
            $subNivels = $em->getRepository('EfiGeneralBundle:Nivel')->findBy(array("padre" => $valor->getId()),array('id' => 'ASC'));
            foreach ($subNivels as &$subValor) {
                $cont++;
                $subValor->setOrden($cont);
                $em->persist($subValor);
                $em->flush();
            }
        }

        $response = new GeneralResponse();
        $codigo = $request->get('codigoPmi');


        $response->setData("nivel elimninado exitosamente");
        $response->addToMetaData('codigo', $codigo);

        return $response->toJSON();
    }

    /**
     * Creates a form to delete a Nivel entity.
     *
     * @param Nivel $nivel The Nivel entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Nivel $nivel)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('nivel_delete', array('id' => $nivel->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}

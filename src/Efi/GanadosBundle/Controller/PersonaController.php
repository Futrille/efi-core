<?php

namespace Efi\GanadosBundle\Controller;

use Efi\GeneralBundle\Entity\Estado;
use Efi\GeneralBundle\Entity\Municipio;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Efi\GeneralBundle\EfiGeneralBundle as Util;

use Efi\GanadosBundle\Entity\Persona as Persona;
use Efi\GanadosBundle\Entity\Familia as Familia;
use Efi\GeneralBundle\Entity\Pais as Pais;
use Efi\GeneralBundle\Entity\ValorVariable as ValorVariable;
use Efi\GeneralBundle\Entity\Iglesia as Iglesia;
use Efi\GanadosBundle\Form\PersonaType;
use Efi\GanadosBundle\Form\FamiliaType;
use Efi\GanadosBundle\Entity\PersonaRepository;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\GeneralResponse;

/**
 * Persona controller.
 *
 */
class PersonaController extends Controller
{
    private $util = null;

    public function __construct()
    {
        $this->util = new Util();
    }

    /**
     * Lists all Persona entities.
     *
     */
    public function indexAction()
    {
        $this->util = new Util();
        $resultado = $this->util->createResponseObject();
        $perRepo = $this->getDoctrine()->getRepository('EfiGanadosBundle:Persona');

        $vvaList = $perRepo->findAll();

        $resultado['count'] = count($vvaList);
        $resultado['response'] = $vvaList;
        $resultado['resumen'] = $this->consultarPersonasPorTipo();

        return $this->util->efiGetJsonResponse($resultado);
    }

    /**
     * Envia y recibe datos del formulario principal de Personas
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Gestiona el formulario de Personas.",
     *  views = {"all", "ganados"}
     * )
     */
    public function newAction(Request $request)
    {
        $response = new GeneralResponse();
        $persona = new Persona();
        $familia = new Familia();
        $valor = 'nada';
        $action = null;
        if ($request->get('idFamilia') != null && $request->get('idFamilia') > 0){
            $valor = 'Hola Bebe!';
            $familia = $this->getDoctrine()
                ->getRepository('EfiGanadosBundle:Familia')
                ->findOneById($request->get('idFamilia'));
            $action = $this->generateUrl('persona_new', array( 'idFamilia' => $request->get('idFamilia')));
            $form_familia = $this->createForm(FamiliaType::class, $familia, array(
                'action' => $action
            ));

            $valor = $familia;
        }
        else{
            $form_familia = $this->createForm(FamiliaType::class, $familia);
        }


        $form_familia->handleRequest($request);

        $form = $this->createForm(PersonaType::class, $persona);
        $form->handleRequest($request);

//        $validator = $this->get('validator');
//        $errors = $validator->validate($persona);
        if ($form_familia->isSubmitted() && $form_familia->isValid()){
            try{
                $em = $this->getDoctrine()->getManager();
                $familia->setEstado($this->getDoctrine()
                    ->getRepository('EfiGeneralBundle:Estado')
                    ->findOneById(1));
                $familia->setMunicipio($this->getDoctrine()
                    ->getRepository('EfiGeneralBundle:Municipio')
                    ->findOneById(1));
                $familia->setParejaMinisterial(1);
                $familia->setCodigoParejaMinisterial('PRU-1986');

                $em->persist($familia);

                $response->setStatus(GENERAL_RESPONSE_SUCCESS);
                $response->setMessage('Familia registrada satisfactoriamente.');

                if ($form->isSubmitted() && $form->isValid()) {
                    try{
                        $response = $this->validarPersonalizado($persona);
                        if ($response->getStatus() == GENERAL_RESPONSE_SUCCESS){
                            $persona->setEstatus(1);
                            $persona->setIdEstatus($this->getValorVariableDefault('per_estatus'));
                            $persona->setRolfamilia(intval($this->getDoctrine()
                                ->getRepository('EfiGeneralBundle:ValorVariable')
                                ->find($persona->getIdRolFamilia())->getValor()));
                            $persona->setUpdatedAt(new \DateTime('now'));
                            if ($persona->getCreatedAt() == null) {
                                $persona->setCreatedAt(new \DateTime('now'));
                            }
                            $persona->setParejaMinisterial(1);
                            $persona->setCodigoParejaMinisterial('PRU-1986');
                            $persona->setFamilia($familia);
                            $em->persist($persona);
                            $em->flush();

                            $response->setStatus(GENERAL_RESPONSE_SUCCESS);
                            $response->setMessage('Persona registrada satisfactoriamente');
                            $response->addToMetaData('personas',$this->getDoctrine()
                                ->getRepository('EfiGanadosBundle:Persona')
                                ->findBy(
                                    array('familia' => 1)
                                ));

                            $persona = new Persona();
                            $form_familia = $this->createForm(FamiliaType::class, $familia);
                            $form = $this->createForm(PersonaType::class, $persona);
                        }
                    }catch (\Exception $e){
                        $response->setStatus(GENERAL_RESPONSE_ERROR);
                        $response->setMessage('Error al guardar el registro.');
                        $response->addToMetaData('message',$e->getMessage());
                    }

                }
                else{
                    $em->flush();
                }
            }
            catch(\Exception $e){
                $response->setStatus(GENERAL_RESPONSE_ERROR);
                $response->setMessage('Error al guardar la Familia.');
                $response->addToMetaData('message',$e->getMessage());
            }

        }

        $response->setData($this->render('persona/new.html.twig', array(
            'persona' => $persona,
            'form' => $form->createView(),
            'familia' => $familia,
            'form_familia' => $form_familia->createView(),
        ))->getContent());
        $response->addToMetaData('valor',$valor);

        return $response->toJSON();
    }

    /**
     * Consulta los datos de una Persona
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Consultar una Persona",
     *  views = {"all", "ganados"}
     * )
     */
    public function showAction(Persona $persona)
    {
        $response = new GeneralResponse();

        $response->setData($persona);

        return $response->toJSON();
    }

    /**
     * Displays a form to edit an existing Persona entity.
     * @param Request $request
     * @param Persona $persona
     * @return \Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\Response
     *
     * Muestra Formulario de Edicion de Persona
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Gestiona el formulario de Edicion de Personas.",
     *  views = {"all", "ganados"}
     * )
     */
    public function editAction(Request $request, Persona $persona)
    {
        $response = new GeneralResponse();
        $familia = null;

        $familia = $this->getDoctrine()
            ->getRepository('EfiGeneralBundle:Familia')
            ->find($persona->getFamilia());

        $form_familia = $this->createForm(FamiliaType::class, $familia);
        $form_familia->handleRequest($request);

        $deleteForm = $this->createDeleteForm($persona);

        $form = $this->createForm(PersonaType::class, $persona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try{
                $response = $this->validarPersonalizado($persona);
                if ($response->getStatus() == GENERAL_RESPONSE_SUCCESS){
                    $em = $this->getDoctrine()->getManager();

                    if ($form_familia->isSubmitted() && $form_familia->isValid()) {
//                        $em->persist($familia);
                    }


                    $this->_setValoresDefault($persona);
//                    $em->persist($persona);
//                    $em->flush();

                    $response->setStatus(GENERAL_RESPONSE_SUCCESS);
                    $response->setMessage('Persona guardada satisfactoriamente');
                    $response->setData($persona);
                }
            }catch (\Exception $e){
                $response->setStatus(GENERAL_RESPONSE_ERROR);
                $response->setMessage('Error al guardar el registro.');
                $response->setData($e->getMessage());
            }

//            return $response->toJSON();
        }

        return $this->render('persona/new.html.twig', array(
            'persona' => $persona,
            'form' => $form->createView(),
            'familia' => $familia,
            'form_familia' => $form_familia->createView(),
            'delete_form' => $deleteForm->createView(),
        ));

//        if ($editForm->isSubmitted() && $editForm->isValid()) {
//
//        return $this->render('persona/edit.html.twig', array(
//            'persona' => $persona,
//            'form' => $editForm->createView(),
//            'delete_form' => $deleteForm->createView(),
//        ));
    }

    /**
     * Deletes a Persona entity.
     * @param Request $request
     * @param Persona $persona
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function deleteAction(Request $request, Persona $persona)
    {
        $this->util = new Util();
        $resultado = array(
            'status' => 'success',
            'message' => 'Registro Eliminado satisfactoriamente.',
        );

        $form = $this->createDeleteForm($persona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try{
                $em = $this->getDoctrine()->getManager();
                $em->remove($persona);
                $em->flush();
            }catch (\Exception $e){
                $resultado['status'] = "error";
                $resultado['message'] = "Error intentando eliminar el registro.";
                $resultado['exception'] = $e->getMessage();
            }
        }

        return $this->util->efiGetJsonResponse($resultado);
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
     * Cuenta la cantidad de Personas Registradas
     *
     * @ApiDoc(
     *  resource=true,
     *  description="Cantidad de Personas Registradas",
     *  views = {"all", "ganados"}
     * )
     */
    public function countAction()
    {
        $response = new GeneralResponse();

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            "SELECT count(p) AS cantidad " .
            "FROM EfiGanadosBundle:Persona p ");

        $objectTest = $query->setMaxResults(1)->getOneOrNullResult();

        if ($objectTest != null){
            $response->setData(intval($objectTest['cantidad']));
        }

        return $response->toJSON();
    }
    /*
     * SELECT MET.MET_ID, MET.MET_NOMBRE, count(PER.MET_ID)
FROM METODOS_GANAR MET
	LEFT OUTER JOIN PERSONAS PER ON MET.MET_ID = PER.MET_ID
GROUP BY MET.MET_ID
     */

    public function consultarPersonasPorTipo(){
        $this->util = new Util();
        $resultado = array(
            'status' => 'success',
            'message' => '',
            'response' => 0,
        );

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            "SELECT m.id, m.nombre, count(p.metodoGanar) AS cantidad " .
            "FROM EfiGanadosBundle:MetodoGanar m ".
            "   LEFT JOIN EfiGanadosBundle:Persona p WITH m.id = p.metodoGanar ".
            "GROUP BY m.id ");
//            "SELECT count(p) AS cantidad " .
//            "FROM EfiGanadosBundle:Persona p ");

//        $objectTest = $query->getResults();
//
//        if ($objectTest != null){
//            $resultado['response'] = $objectTest['cantidad'];
//        }

        return $query->getResult();
    }

    /**
     * @param $codigo
     * @param $valor
     * @return object ValorVariable
     */
    public function getValorVariableByCodigoAndValor($codigo, $valor){
        return $this->getDoctrine()
            ->getRepository('EfiGeneralBundle:ValorVariable')
            ->findOneBy(
                array(
                    'codigo' => $codigo,
                    'valor' => $valor
                )
            );
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

    /**
     * @param Persona $persona
     */
    private function _setValoresDefault(Persona $persona){
        $estatusDefault = 1;
        $rolFamilia = 1;

        if ($persona->getId() == null || ($persona->getId() != null && $persona->getId() < 1 )){
            $persona->setEstatus($estatusDefault);
            $persona->setIdEstatus($this->getValorVariableDefault('per_estatus'));

            $persona->setRolfamilia($rolFamilia);
            $persona->setIdRolFamilia($this->getValorVariableDefault('per_rol'));

            $persona->setUpdatedAt(new \DateTime('now'));

            if ($persona->getCreatedAt() == null) {
                $persona->setCreatedAt(new \DateTime('now'));
            }


            $persona->setParejaMinisterial(1);
            $persona->setCodigoParejaMinisterial('PRU-1986');

//            $familiar = $this->getDoctrine()
//                ->getRepository('EfiGeneralBundle:Pais')
//                ->find($paisDefault);
//            /** @var Pais $pais */
//            $persona->setPais($pais);
        }
    }

    /**
     * Valida que el registro no tenga Cedula o Correo repetidos
     * @param Persona $persona
     */
    private function validarPersonalizado(Persona $persona){
        $response = new GeneralResponse();
        $id = $persona->getId() == null ? 0 : $persona->getId();

        $objectTest = null;
//        $em = $this->getDoctrine()->getManager();
//        $query = $em->createQuery(
//            "SELECT p " .
//            "FROM EfiGanadosBundle:Persona p " .
//            "WHERE p.id <> :id AND p.cedula = :cedula")
//            ->setParameter('id', $id)
//            ->setParameter('cedula', $persona->getCedula());
//        $objectTest = $query->setMaxResults(1)->getOneOrNullResult();
//
//        if ($objectTest != null){
//            $resultado = array(
//                'status' => 'error',
//                'message' => 'El numero de cedula <b>' . $persona->getCedula() . '</b> ya se encuentra registrado.',
//            );
//            return $resultado;
//        }

        if ($persona->getCorreo() != null && $persona->getCorreo() != ''){
            $objectTest = null;
            $em = $this->getDoctrine()->getManager();
            $query = $em->createQuery(
                "SELECT p " .
                "FROM EfiGanadosBundle:Persona p " .
                "WHERE p.id <> :id AND p.correo = :correo ")
                ->setParameter('id', $id)
                ->setParameter('correo', $persona->getCorreo());
            $objectTest = $query->setMaxResults(1)->getOneOrNullResult();

            if ($objectTest != null){
                $response->setStatus(1);
                $response->setMessage('El correo <b>' . $persona->getCorreo() . '</b> ya se encuentra registrado.');
                return $response;
            }
        }

        return $response;
    }
}

<?php

namespace Efi\GanadosBundle\Controller;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\DBAL\DBALException;

use Efi\GeneralBundle\EfiGeneralBundle as Util;

use Efi\GanadosBundle\Entity\Persona as Persona;
use Efi\GeneralBundle\Entity\Pais as Pais;
use Efi\GeneralBundle\Entity\ValorVariable as ValorVariable;
use Efi\GeneralBundle\Entity\Iglesia as Iglesia;
use Efi\GanadosBundle\Form\PersonaType;
use Efi\GanadosBundle\Entity\PersonaRepository;

use Symfony\Component\Security\Csrf\CsrfTokenManager;

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
        $this->util = new Util();
        $resultado = array();

        //$key = $request->query->get('key',0);
        $vvaList = $this->getDoctrine()
            ->getRepository('EfiGanadosBundle:Persona')
            ->findAll();

        $resultado['status'] = "success";
        $resultado['message'] = "";
        $resultado['response'] = $vvaList;
        $resultado['resumen'] = $this->consultarPersonasPorTipo();

        return $this->util->efiGetJsonResponse($resultado);
    }

    /**
     * Creates a new Persona entity.
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function newAction(Request $request)
    {
        $this->util = new Util();
        $resultado = array();

        $persona = new Persona();

        $form = $this->createForm('Efi\GanadosBundle\Form\PersonaType', $persona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try{
                $resultado = $this->validarPersonalizado($persona);
                if ($resultado['status'] == 'success'){
                    $em = $this->getDoctrine()->getManager();

                    $this->_setValoresDefault($persona);

                    $em->persist($persona);
                    $em->flush();

                    $resultado['message'] = 'Persona registrada satisfactoriamente';
                    $resultado['response'] = $persona;
                }
            }catch (\Exception $e){
                $resultado['status'] = "error";
                $resultado['message'] = "Error al guardar el registro.";
                $resultado['exception'] = $e->getMessage();
            }

            return $this->util->efiGetJsonResponse($resultado);
        }
//        $token_manager = new CsrfTokenManager();
//        $token = $token_manager->getToken("_token");
//        return $this->util->efiGetJsonResponse($token);
        return $this->render('persona/new.html.twig', array(
            'persona' => $persona,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Persona entity.
     * @param Persona $persona
     * @return \Symfony\Component\HttpFoundation\Response
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
     * @param Request $request
     * @param Persona $persona
     * @return \Symfony\Component\HttpFoundation\JsonResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function editAction(Request $request, Persona $persona)
    {
        $this->util = new Util();
        $resultado = array();

        $deleteForm = $this->createDeleteForm($persona);
        $editForm = $this->createForm('Efi\GanadosBundle\Form\PersonaType', $persona);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            try{
                $resultado = $this->validarPersonalizado($persona);
                if ($resultado['status'] == 'success'){
                    $em = $this->getDoctrine()->getManager();

                    $this->_setValoresDefault($persona);

                    $em->persist($persona);
                    $em->flush();

                    $resultado['message'] = 'Persona registrada satisfactoriamente';
                    $resultado['response'] = $persona;
                }
            }catch (\Exception $e){
                $resultado['status'] = "error";
                $resultado['message'] = "Error al guardar el registro.";
                $resultado['exception'] = $e->getMessage();
            }

            return $this->util->efiGetJsonResponse($resultado);
        }

        return $this->render('persona/edit.html.twig', array(
            'persona' => $persona,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
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
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function countAction()
    {
        $this->util = new Util();
        $resultado = array(
            'status' => 'success',
            'message' => '',
            'response' => 0,
        );

        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            "SELECT count(p) AS cantidad " .
            "FROM EfiGanadosBundle:Persona p ");

        $objectTest = $query->setMaxResults(1)->getOneOrNullResult();

        if ($objectTest != null){
            $resultado['response'] = $objectTest['cantidad'];
        }

        return $this->util->efiGetJsonResponse($resultado);
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
     * @param Persona $persona
     */
    private function _setValoresDefault(Persona $persona){

        $estatusDefault = 1;
        $esCompletoDefault = 1;
        $paisDefault = 1;
        $iglesiaDefault = 1;

        if ($persona->getId() == null || ($persona->getId() != null && $persona->getId() < 1 )){
            $persona->setEstatus($estatusDefault);
            $idEstatus = $this->getDoctrine()
                ->getRepository('EfiGeneralBundle:ValorVariable')
                ->findOneBy(
                    array('codigo' => 'per_estatus', 'valor' => $estatusDefault)
                );
            /** @var ValorVariable $idEstatus */
            $persona->setIdEstatus($idEstatus);

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

        //Verificando que est� completo el registro
        if ($persona->getCedula() == null || $persona->getCedula() == ''
            || $persona->getTelefono() == null || $persona->getTelefono() == ''
            || $persona->getCorreo() == null || $persona->getCorreo() == ''
        ){
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
    }

    /**
     * Valida que el registro no tenga Cedula o Correo repetidos
     * @param Persona $persona
     */
    private function validarPersonalizado(Persona $persona){
        $resultado = array(
            'status' => 'success',
            'message' => '',
        );
        $id = $persona->getId() == null ? 0 : $persona->getId();

        $objectTest = null;
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            "SELECT p " .
            "FROM EfiGanadosBundle:Persona p " .
            "WHERE p.id <> :id AND p.cedula = :cedula")
            ->setParameter('id', $id)
            ->setParameter('cedula', $persona->getCedula());
        $objectTest = $query->setMaxResults(1)->getOneOrNullResult();

        if ($objectTest != null){
            $resultado = array(
                'status' => 'error',
                'message' => 'El numero de cedula <b>' . $persona->getCedula() . '</b> ya se encuentra registrado.',
            );
            return $resultado;
        }

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
                $resultado = array(
                    'status' => 'error',
                    'message' => 'El correo <b>' . $persona->getCorreo() . '</b> ya se encuentra registrado.',
                );
                return $resultado;
            }
        }

        return $resultado;
    }
}

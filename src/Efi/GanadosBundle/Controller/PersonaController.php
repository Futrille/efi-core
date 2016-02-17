<?php

namespace Efi\GanadosBundle\Controller;

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
        //$key = $request->query->get('key',0);
        $vvaList = $this->getDoctrine()
            ->getRepository('EfiGanadosBundle:Persona')
            ->findAll();

        return $this->util->efiGetJsonResponse($vvaList);
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
        if ($request->get('valor', '-1') != '-1'){
            echo "Vino parametro successfully";
        }
        $persona = new Persona();
        $form = $this->createForm(PersonaType::class, $persona);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            try{
                if (!$this->isCedulaRepetida($persona)){
                    echo "Submitted and Valid...";
                    $em = $this->getDoctrine()->getManager();

                    $this->_setValoresDefault($persona);

                    $em->persist($persona);
                    $em->flush();

                    $resultado = $persona;
                }
                else{
                    $resultado['status'] = "ERROR";
                    $resultado['mensaje'] = "El numero de cedula ya se encuentra registrado.";
                    //$form->get('cedula')->addError(new FormError("El numero de cedula ya se encuentra registrado."));
                }
            }catch (\Exception $e){
                $resultado['status'] = "ERROR";
                $resultado['mensaje'] = "Error al guardar el registro.";
            }

            return $this->util->efiGetJsonResponse($resultado);
        }

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

        $deleteForm = $this->createDeleteForm($persona);
        $editForm = $this->createForm('Efi\GanadosBundle\Form\PersonaType', $persona);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em = $this->getDoctrine()->getManager();

            $this->_setValoresDefault($persona);

            $em->persist($persona);
            $em->flush();

            return $this->util->efiGetJsonResponse($persona);
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

    /**
     * @param Persona $persona
     */
    private function isCedulaRepetida(Persona $persona){
        $resultado = $this->getDoctrine()
            ->getRepository('EfiGanadosBundle:Persona')
            ->findOneBy(
                array('cedula' => $persona->getCedula())
            );
        if ($resultado != null){
            return true;
        }
        return false;
    }
}

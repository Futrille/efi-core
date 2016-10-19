<?php
namespace Efi\GanadosBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * Class PersonaRepository
 * @package Efi\GanadosBundle\Entity
 */
class PersonaRepository extends EntityRepository
{
    /**
     * @param int $id
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findRepeatedWithoutSelf($id){
        $query = $this->createQueryBuilder('p')
            ->where('p.id <> :id')
            ->setParameter('id', $id)
            ->getQuery();
        $objectTest = $query->setMaxResults(1)->getOneOrNullResult();
    }

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

        return $query->getResult();
    }
}
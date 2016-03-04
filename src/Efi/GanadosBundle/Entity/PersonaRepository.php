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
    public function findRepeatedWithoutSelf(int $id){
        $query = $this->createQueryBuilder('p')
            ->where('p.id <> :id')
            ->setParameter('id', $id)
            ->getQuery();
        $objectTest = $query->setMaxResults(1)->getOneOrNullResult();
    }
}
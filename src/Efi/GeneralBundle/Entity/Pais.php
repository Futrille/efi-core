<?php

namespace Efi\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pais
 *
 * @ORM\Table(name="PAISES")
 * @ORM\Entity
 */
class Pais
{
    /**
     * @var integer
     *
     * @ORM\Column(name="PAI_ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="PAI_NOMBRE", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="PAI_CODIGOISO", type="string", length=3, nullable=false)
     */
    private $codigoIso;

    /**
     * @var string
     *
     * @ORM\Column(name="PAI_ABREVIATURA", type="string", length=2, nullable=false)
     */
    private $abreviatura;

    /**
     * @return string
     */
    public function __toString(){
        return $this->getNombre();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param string $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return string
     */
    public function getCodigoIso()
    {
        return $this->codigoIso;
    }

    /**
     * @param string $codigoIso
     */
    public function setCodigoIso($codigoIso)
    {
        $this->codigoIso = $codigoIso;
    }

    /**
     * @return string
     */
    public function getAbreviatura()
    {
        return $this->abreviatura;
    }

    /**
     * @param string $abreviatura
     */
    public function setAbreviatura($abreviatura)
    {
        $this->abreviatura = $abreviatura;
    }


}


<?php

namespace Efi\GanadosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MetodoGanar
 *
 * @ORM\Table(name="metodos_ganar")
 * @ORM\Entity
 */
class MetodoGanar
{
    /**
     * @var integer
     *
     * @ORM\Column(name="MET_ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="MET_NOMBRE", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="MET_DESCRIPCION", type="string", length=500, nullable=false)
     */
    private $descripcion;

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
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param string $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }


}

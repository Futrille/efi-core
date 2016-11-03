<?php

namespace Efi\GanadosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Efi\GeneralBundle\Entity\Estado;
use Efi\GeneralBundle\Entity\Municipio;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Familia
 *
 * @ORM\Table(name="familias", indexes={@ORM\Index(name="fk_FAMILIAS_ESTADOS1_idx", columns={"EDO_ID"}), @ORM\Index(name="fk_FAMILIAS_MUNICIPIOS1_idx", columns={"MCP_ID"})})
 * @ORM\Entity
 */
class Familia
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FAM_ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank(message = "Este campo no puede estar vacio.")
     *
     * @ORM\Column(name="FAM_NOMBRE", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="FAM_DIRECCION", type="string", length=500, nullable=false)
     */
    private $direccion;

    /**
     * @var Estado
     *
     * @ORM\ManyToOne(targetEntity="\Efi\GeneralBundle\Entity\Estado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="EDO_ID", referencedColumnName="EDO_ID")
     * })
     */
    private $estado;

    /**
     * @var Municipio
     *
     * @ORM\ManyToOne(targetEntity="\Efi\GeneralBundle\Entity\Municipio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="MCP_ID", referencedColumnName="MCP_ID")
     * })
     */
    private $municipio;

    /**
     * @ORM\OneToMany(targetEntity="\Efi\GanadosBundle\Entity\Persona", mappedBy="familia")
     */
    private $personas;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->personas = new \Doctrine\Common\Collections\ArrayCollection();
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
    public function getDireccion()
    {
        return $this->direccion;
    }

    /**
     * @param string $direccion
     */
    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
    }

    /**
     * @return Estado
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param Estado $estado
     */
    public function setEstado($estado)
    {
        $this->estado = $estado;
    }

    /**
     * @return Municipio
     */
    public function getMunicipio()
    {
        return $this->municipio;
    }

    /**
     * @param Municipio $municipio
     */
    public function setMunicipio($municipio)
    {
        $this->municipio = $municipio;
    }


}

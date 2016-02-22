<?php

namespace Efi\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Direccion
 *
 * @ORM\Table(name="DIRECCIONES", indexes={@ORM\Index(name="fk_DIRECCIONES_MUNICIPIOS1_idx", columns={"MCP_ID"}), @ORM\Index(name="fk_DIRECCIONES_ESTADOS1_idx", columns={"EDO_ID"}), @ORM\Index(name="fk_DIRECCIONES_PAISES1_idx", columns={"PAI_ID"})})
 * @ORM\Entity
 */
class Direccion
{
    /**
     * @var integer
     *
     * @ORM\Column(name="DIR_ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="DIR_URBANIZACION", type="string", length=100, nullable=true)
     */
    private $urbanizacion;

    /**
     * @var string
     *
     * @ORM\Column(name="DIR_SECTOR", type="string", length=100, nullable=true)
     */
    private $sector;

    /**
     * @var string
     *
     * @ORM\Column(name="DIR_CALLE", type="string", length=100, nullable=true)
     */
    private $calle;

    /**
     * @var string
     *
     * @ORM\Column(name="DIR_CASA", type="string", length=100, nullable=true)
     */
    private $casa;

    /**
     * @var string
     *
     * @ORM\Column(name="DIR_PISO", type="string", length=100, nullable=true)
     */
    private $piso;

    /**
     * @var string
     *
     * @ORM\Column(name="DIR_DIRECCION", type="string", length=2000, nullable=true)
     */
    private $direccion;

    /**
     * @var Estado
     *
     * @ORM\ManyToOne(targetEntity="Estado")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="EDO_ID", referencedColumnName="EDO_ID")
     * })
     */
    private $estado;

    /**
     * @var Municipio
     *
     * @ORM\ManyToOne(targetEntity="Municipio")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="MCP_ID", referencedColumnName="MCP_ID")
     * })
     */
    private $municipio;

    /**
     * @var Pais
     *
     * @ORM\ManyToOne(targetEntity="Pais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="PAI_ID", referencedColumnName="PAI_ID")
     * })
     */
    private $pais;

//    /**
//     * @var \Doctrine\Common\Collections\Collection
//     *
//     * @ORM\ManyToMany(targetEntity="Lideres", mappedBy="dir")
//     */
//    private $lideres;


    /**
     * Constructor
     */
    public function __construct()
    {
//        $this->lideres = new \Doctrine\Common\Collections\ArrayCollection();
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
    public function getUrbanizacion()
    {
        return $this->urbanizacion;
    }

    /**
     * @param string $urbanizacion
     */
    public function setUrbanizacion($urbanizacion)
    {
        $this->urbanizacion = $urbanizacion;
    }

    /**
     * @return string
     */
    public function getSector()
    {
        return $this->sector;
    }

    /**
     * @param string $sector
     */
    public function setSector($sector)
    {
        $this->sector = $sector;
    }

    /**
     * @return string
     */
    public function getCalle()
    {
        return $this->calle;
    }

    /**
     * @param string $calle
     */
    public function setCalle($calle)
    {
        $this->calle = $calle;
    }

    /**
     * @return string
     */
    public function getCasa()
    {
        return $this->casa;
    }

    /**
     * @param string $casa
     */
    public function setCasa($casa)
    {
        $this->casa = $casa;
    }

    /**
     * @return string
     */
    public function getPiso()
    {
        return $this->piso;
    }

    /**
     * @param string $piso
     */
    public function setPiso($piso)
    {
        $this->piso = $piso;
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

    /**
     * @return Pais
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * @param Pais $pais
     */
    public function setPais($pais)
    {
        $this->pais = $pais;
    }

}


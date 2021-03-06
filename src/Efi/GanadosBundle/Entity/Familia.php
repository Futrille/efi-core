<?php

namespace Efi\GanadosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Efi\GeneralBundle\Entity\Estado;
use Efi\GeneralBundle\Entity\Municipio;
use Symfony\Component\Validator\Constraints as Assert;
use \Doctrine\Common\Collections\ArrayCollection;

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
     * @Assert\NotBlank(message = "Este campo (familia) no puede estar vacio.")
     *
     * @ORM\Column(name="FAM_NOMBRE", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     * @Assert\NotBlank(message = "Este campo (direccion) no puede estar vacio.")
     * @Assert\Length(
     *      max = 500,
     *      maxMessage = "Solo se permiten {{ limit }} caracteres"
     * )
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
     * @var string
     *
     * @ORM\Column(name="PMI_CODIGO", type="string", length=50, nullable=false)
     */
    private $codigoParejaMinisterial;

//    /**
//     * @var \ParejasMinisteriales
//     *
//     * @ORM\ManyToOne(targetEntity="ParejasMinisteriales")
//     * @ORM\JoinColumns({
//     *   @ORM\JoinColumn(name="PMI_ID", referencedColumnName="PMI_ID")
//     * })
//     */
    /**
     * @var integer
     *
     * @ORM\Column(name="PMI_ID", type="integer", nullable=false)
     */
    private $parejaMinisterial;

    /**
     * @ORM\OneToMany(targetEntity="\Efi\GanadosBundle\Entity\Persona", mappedBy="familia")
     */
    private $personas;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->personas = new ArrayCollection();
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

        return $this;
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

        return $this;
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

        return $this;
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

        return $this;
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

        return $this;
    }

    /**
     * @return string
     */
    public function getCodigoParejaMinisterial()
    {
        return $this->codigoParejaMinisterial;
    }

    /**
     * @param string $codigoParejaMinisterial
     */
    public function setCodigoParejaMinisterial($codigoParejaMinisterial)
    {
        $this->codigoParejaMinisterial = $codigoParejaMinisterial;
    }

    /**
     * @return int
     */
    public function getParejaMinisterial()
    {
        return $this->parejaMinisterial;
    }

    /**
     * @param int $parejaMinisterial
     */
    public function setParejaMinisterial($parejaMinisterial)
    {
        $this->parejaMinisterial = $parejaMinisterial;
    }

    /**
     * @return mixed
     */
    public function getPersonas()
    {
        return $this->personas;
    }

    /**
     * @param mixed $personas
     */
    public function setPersonas($personas)
    {
        $this->personas = $personas;

        return $this;
    }

    /**
     * @param Persona $persona
     * @return $this
     */
    public function addPersona(Persona $persona)
    {
        $this->personas[] = $persona;

        return $this;
    }

    /**
     * @param Persona $persona
     */
    public function removePersona(Persona $persona)
    {
        $this->personas->removeElement($persona);
    }



}

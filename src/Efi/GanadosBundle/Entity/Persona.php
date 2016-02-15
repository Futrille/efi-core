<?php

namespace Efi\GanadosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \Efi\GeneralBundle\Entity\ValorVariable as ValorVariable;
use \Efi\GeneralBundle\Entity\Iglesia as Iglesia;

/**
 * Persona
 *
 * @ORM\Table(name="personas", indexes={@ORM\Index(name="fk_PERSONAS_PAISES1_idx", columns={"PAI_ID"}), @ORM\Index(name="fk_PERSONAS_VALORESVARIABLES1_idx", columns={"VVA_IDESTATUS"}), @ORM\Index(name="fk_PERSONAS_VALORESVARIABLES2_idx", columns={"VVA_IDESCOMPLETO"}), @ORM\Index(name="fk_PERSONAS_IGLESIAS1_idx", columns={"IGL_ID"}), @ORM\Index(name="fk_PERSONAS_METODOS_GANAR1_idx", columns={"MET_ID"})})
 * @ORM\Entity
 */
class Persona
{
    /**
     * @var integer
     *
     * @ORM\Column(name="PER_ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="PER_ESTATUS", type="integer", nullable=false)
     */
    private $estatus;

    /**
     * @var integer
     *
     * @ORM\Column(name="PER_ESCOMPLETO", type="integer", nullable=false)
     */
    private $esCompleto;

    /**
     * @var integer
     *
     * @ORM\Column(name="PER_FECHANACIMIENTO", type="integer", nullable=false)
     */
    private $fechaNacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="PER_CEDULA", type="string", length=20, nullable=true)
     */
    private $cedula;

    /**
     * @var string
     *
     * @ORM\Column(name="PER_NACIONALIDAD", type="string", length=1, nullable=false)
     */
    private $nacionalidad;

    /**
     * @var string
     *
     * @ORM\Column(name="PER_NOMBRES", type="string", length=100, nullable=false)
     */
    private $nombres;

    /**
     * @var string
     *
     * @ORM\Column(name="PER_APELLIDOS", type="string", length=100, nullable=false)
     */
    private $apellidos;

    /**
     * @var string
     *
     * @ORM\Column(name="PER_SEXO", type="string", length=1, nullable=false)
     */
    private $sexo;

    /**
     * @var \Efi\GeneralBundle\Entity\Iglesia
     *
     * @ORM\ManyToOne(targetEntity="\Efi\GeneralBundle\Entity\Iglesia", inversedBy="personas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IGL_ID", referencedColumnName="IGL_ID")
     * })
     */
    private $iglesia;

    /**
     * @var \Efi\GanadosBundle\Entity\MetodoGanar
     *
     * @ORM\ManyToOne(targetEntity="\Efi\GanadosBundle\Entity\MetodoGanar")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="MET_ID", referencedColumnName="MET_ID")
     * })
     */
    private $metodoGanar;

    /**
     * @var \Efi\GeneralBundle\Entity\Pais
     *
     * @ORM\ManyToOne(targetEntity="\Efi\GeneralBundle\Entity\Pais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="PAI_ID", referencedColumnName="PAI_ID")
     * })
     */
    private $pais;

    /**
     * @var \Efi\GeneralBundle\Entity\ValorVariable
     *
     * @ORM\ManyToOne(targetEntity="\Efi\GeneralBundle\Entity\ValorVariable")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="VVA_IDESTATUS", referencedColumnName="VVA_ID")
     * })
     */
    private $idEstatus;

    /**
     * @var \Efi\GeneralBundle\Entity\ValorVariable
     *
     * @ORM\ManyToOne(targetEntity="\Efi\GeneralBundle\Entity\ValorVariable")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="VVA_IDESCOMPLETO", referencedColumnName="VVA_ID")
     * })
     */
    private $idEsCompleto;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="\Efi\GeneralBundle\Entity\Direccion", inversedBy="personas")
     * @ORM\JoinTable(name="personas_has_direcciones",
     *   joinColumns={
     *     @ORM\JoinColumn(name="PER_ID", referencedColumnName="PER_ID")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="DIR_ID", referencedColumnName="DIR_ID")
     *   }
     * )
     */
    private $direcciones;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="\Efi\GeneralBundle\Entity\Telefono", inversedBy="personas")
     * @ORM\JoinTable(name="personas_has_telefonos",
     *   joinColumns={
     *     @ORM\JoinColumn(name="PER_ID", referencedColumnName="PER_ID")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="TLF_ID", referencedColumnName="TLF_ID")
     *   }
     * )
     */
    private $telefonos;

    /**
     * @return string
     */
    public function __toString(){
        return $this->getNombres() . ' ' . $this->getApellidos();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->direcciones = new \Doctrine\Common\Collections\ArrayCollection();
        $this->telefonos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return int
     */
    public function getEstatus()
    {
        return $this->estatus;
    }

    /**
     * @param int $estatus
     */
    public function setEstatus($estatus)
    {
        $this->estatus = $estatus;
    }

    /**
     * @return int
     */
    public function getEsCompleto()
    {
        return $this->esCompleto;
    }

    /**
     * @param int $esCompleto
     */
    public function setEsCompleto($esCompleto)
    {
        $this->esCompleto = $esCompleto;
    }

    /**
     * @return int
     */
    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    /**
     * @param int $fechaNacimiento
     */
    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    /**
     * @return string
     */
    public function getCedula()
    {
        return $this->cedula;
    }

    /**
     * @param string $cedula
     */
    public function setCedula($cedula)
    {
        $this->cedula = $cedula;
    }

    /**
     * @return string
     */
    public function getNacionalidad()
    {
        return $this->nacionalidad;
    }

    /**
     * @param string $nacionalidad
     */
    public function setNacionalidad($nacionalidad)
    {
        $this->nacionalidad = $nacionalidad;
    }

    /**
     * @return string
     */
    public function getNombres()
    {
        return $this->nombres;
    }

    /**
     * @param string $nombres
     */
    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
    }

    /**
     * @return string
     */
    public function getApellidos()
    {
        return $this->apellidos;
    }

    /**
     * @param string $apellidos
     */
    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    /**
     * @return string
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * @param string $sexo
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    /**
     * @return Iglesia
     */
    public function getIglesia()
    {
        return $this->iglesia;
    }

    /**
     * @param Iglesia $iglesia
     */
    public function setIglesia($iglesia)
    {
        $this->iglesia = $iglesia;
    }

    /**
     * @return MetodoGanar
     */
    public function getMetodoGanar()
    {
        return $this->metodoGanar;
    }

    /**
     * @param MetodoGanar $metodoGanar
     */
    public function setMetodoGanar($metodoGanar)
    {
        $this->metodoGanar = $metodoGanar;
    }

    /**
     * @return \Efi\GeneralBundle\Entity\Pais
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * @param \Efi\GeneralBundle\Entity\Pais $pais
     */
    public function setPais($pais)
    {
        $this->pais = $pais;
    }

    /**
     * @return ValorVariable
     */
    public function getIdEstatus()
    {
        return $this->idEstatus;
    }

    /**
     * @param ValorVariable $idEstatus
     */
    public function setIdEstatus($idEstatus)
    {
        $this->idEstatus = $idEstatus;
    }

    /**
     * @return ValorVariable
     */
    public function getIdEsCompleto()
    {
        return $this->idEsCompleto;
    }

    /**
     * @param ValorVariable $idEsCompleto
     */
    public function setIdEsCompleto($idEsCompleto)
    {
        $this->idEsCompleto = $idEsCompleto;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDirecciones()
    {
        return $this->direcciones;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $direcciones
     */
    public function setDirecciones($direcciones)
    {
        $this->direcciones = $direcciones;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTelefonos()
    {
        return $this->telefonos;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $telefonos
     */
    public function setTelefonos($telefonos)
    {
        $this->telefonos = $telefonos;
    }

}
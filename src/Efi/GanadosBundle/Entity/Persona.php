<?php

namespace Efi\GanadosBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use \Efi\GeneralBundle\Entity\ValorVariable as ValorVariable;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Persona
 *
 * @ORM\Table(name="personas", uniqueConstraints={@ORM\UniqueConstraint(name="PER_CORREO_UNIQUE", columns={"PER_CORREO"})}, indexes={@ORM\Index(name="fk_PERSONAS_VALORESVARIABLES1_idx", columns={"VVA_IDESTATUS"}), @ORM\Index(name="fk_PERSONAS_METODOS_GANAR1_idx", columns={"MET_ID"}), @ORM\Index(name="fk_PERSONAS_FAMILIAS1_idx", columns={"FAM_ID"}), @ORM\Index(name="fk_PERSONAS_VALORES_VARIABLES1_idx", columns={"VVA_IDROLFAMILIA"}), @ORM\Index(name="fk_PERSONAS_PAREJAS_MINISTERIALES1_idx", columns={"PMI_ID"})})
 * @ORM\Entity(repositoryClass="Efi\GanadosBundle\Entity\PersonaRepository")
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
     * @ORM\Column(name="PER_ROLFAMILIA", type="integer", nullable=false)
     */
    private $rolFamilia;

    /**
     * @var string
     * @Assert\NotBlank(message = "Este campo no puede estar vacio.")
     * @Assert\Length(
     *      max = 100,
     *      maxMessage = "Solo se permiten {{ limit }} caracteres"
     * )
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=false,
     *     message="No se permiten Numeros."
     * )
     *
     * @ORM\Column(name="PER_NOMBRES", type="string", length=100, nullable=false)
     */
    private $nombres;

    /**
     * @var string
     * @Assert\Length(
     *      max = 50,
     *      maxMessage = "Solo se permiten {{ limit }} caracteres"
     * )
     * @Assert\Email(
     *     message = "Ingrese un Correo valido.",
     *     checkMX = true
     * )
     *
     * @ORM\Column(name="PER_CORREO", type="string", length=50, nullable=true)
     */
    private $correo;

    /**
     * @var string
     * @Assert\Length(
     *      max = 50,
     *      maxMessage = "Solo se permiten {{ limit }} caracteres"
     * )
     * @Assert\Regex(
     *     pattern="/\d/",
     *     match=true,
     *     message="Solo se permiten numeros"
     * )
     *
     * @ORM\Column(name="PER_TELEFONO", type="string", length=50, nullable=true)
     */
    private $telefono;

    /**
     * @var \DateTime
     * @Assert\NotBlank(message = "Este campo no puede estar vacio.")
     * @Assert\Date(
     *     message = "Ingrese una fecha valida"
     * )
     *
     * @ORM\Column(name="PER_FECHAGANADO", type="datetime", nullable=false)
     */
    private $fechaGanado;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="PER_CREATED_AT", type="datetime", nullable=false)
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="PER_UPDATED_AT", type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     * @var Familia
     *
     * @ORM\ManyToOne(targetEntity="Familia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="FAM_ID", referencedColumnName="FAM_ID")
     * })
     */
    private $familia;

    /**
     * @var MetodoGanar
     *
     * @ORM\ManyToOne(targetEntity="MetodoGanar")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="MET_ID", referencedColumnName="MET_ID")
     * })
     */
    private $metodoGanar;



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
     * @var string
     *
     * @ORM\Column(name="PMI_CODIGO", type="string", length=50, nullable=true)
     */
    private $codigoParejaMinisterial;

    /**
     * @var \Efi\GeneralBundle\Entity\ValorVariable
     *
     * @ORM\ManyToOne(targetEntity="Efi\GeneralBundle\Entity\ValorVariable")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="VVA_IDESTATUS", referencedColumnName="VVA_ID")
     * })
     */
    private $idEstatus;

    /**
     * @var \Efi\GeneralBundle\Entity\ValorVariable
     *
     * @ORM\ManyToOne(targetEntity="Efi\GeneralBundle\Entity\ValorVariable")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="VVA_IDROLFAMILIA", referencedColumnName="VVA_ID")
     * })
     */
    private $idRolFamilia;

    /**
     * Many Users have One Address.
     * @ORM\ManyToOne(targetEntity="Efi\GeneralBundle\Entity\Nivel")
     * @ORM\JoinColumn(name="NIV_ID", referencedColumnName="NIV_ID")
     */
    private $nivel;

    /**
     * @return string
     */
    public function __toString(){
        return $this->getNombres();
    }

    /**
     *
     * @ORM\PrePersist
     * @ORM\PreUpdate
     */
    public function updatedTimestamps()
    {
        $this->setUpdatedAt(new \DateTime('now'));

        if ($this->getCreatedAt() == null) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }

    /**
     * Constructor
     */
    public function __construct()
    {
//        $this->direcciones = new \Doctrine\Common\Collections\ArrayCollection();
//        $this->telefonos = new \Doctrine\Common\Collections\ArrayCollection();
//        $this->setCreatedAt(new \DateTime('now'));
//        $this->setUpdatedAt(new \DateTime('now'));
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
    public function getRolfamilia()
    {
        return $this->rolFamilia;
    }

    /**
     * @param int $rolFamilia
     */
    public function setRolfamilia($rolFamilia)
    {
        $this->rolFamilia = $rolFamilia;
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
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * @param string $correo
     */
    public function setCorreo($correo)
    {
        $this->correo = $correo;
    }

    /**
     * @return string
     */
    public function getTelefono()
    {
        return $this->telefono;
    }

    /**
     * @param string $telefono
     */
    public function setTelefono($telefono)
    {
        $this->telefono = $telefono;
    }

    /**
     * @return \DateTime
     */
    public function getFechaGanado()
    {
        return $this->fechaGanado;
    }

    /**
     * @param \DateTime $fechaGanado
     */
    public function setFechaGanado($fechaGanado)
    {
        $this->fechaGanado = $fechaGanado;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
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
     * @return mixed
     */
    public function getFamilia()
    {
        return $this->familia;
    }

    /**
     * @param mixed $familia
     */
    public function setFamilia($familia)
    {
        $this->familia = $familia;
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

    
//    /**
//     * @return \Familia
//     */
//    public function getFamilia()
//    {
//        return $this->familia;
//    }
//
//    /**
//     * @param \Familia $familia
//     */
//    public function setFamilia($familia)
//    {
//        $this->familia = $familia;
//    }



    /**
     * @return \Efi\GeneralBundle\Entity\ValorVariable
     */
    public function getIdEstatus()
    {
        return $this->idEstatus;
    }

    /**
     * @param \Efi\GeneralBundle\Entity\ValorVariable $idEstatus
     */
    public function setIdEstatus($idEstatus)
    {
        $this->idEstatus = $idEstatus;
    }

    /**
     * @return \Efi\GeneralBundle\Entity\ValorVariable
     */
    public function getIdRolFamilia()
    {
        return $this->idRolFamilia;
    }

    /**
     * @param \Efi\GeneralBundle\Entity\ValorVariable $idRolFamilia
     */
    public function setIdRolFamilia($idRolFamilia)
    {
        $this->idRolFamilia = $idRolFamilia;
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
     * @return mixed
     */
    public function getNiveles()
    {
        return $this->nivel;
    }

    /**
     * @param mixed $nivel
     */
    public function setNiveles($nivel)
    {
        $this->nivel = $nivel;
    }


}

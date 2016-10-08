<?php

namespace Efi\GanadosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \Efi\GeneralBundle\Entity\ValorVariable as ValorVariable;
use \Efi\GeneralBundle\Entity\Iglesia as Iglesia;

/**
 * Persona
 *
 * @ORM\Table(name="PERSONAS", @ORM\UniqueConstraint(name="PER_CORREO_UNIQUE", columns={"PER_CORREO"}), @ORM\Index(name="fk_PERSONAS_VALORESVARIABLES1_idx", columns={"VVA_IDESTATUS"}), @ORM\Index(name="fk_PERSONAS_METODOS_GANAR1_idx", columns={"MET_ID"}))
 * @ORM\HasLifecycleCallbacks
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
     * @var string
     *
     * @ORM\Column(name="PER_NOMBRES", type="string", length=100, nullable=false)
     */
    private $nombres;

    /**
     * @var string
     *
     * @ORM\Column(name="PER_CORREO", type="string", length=50, nullable=true)
     */
    private $correo;

    /**
     * @var \DateTime
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
     * @var \Efi\GanadosBundle\Entity\MetodoGanar
     *
     * @ORM\ManyToOne(targetEntity="\Efi\GanadosBundle\Entity\MetodoGanar")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="MET_ID", referencedColumnName="MET_ID")
     * })
     */
    private $metodoGanar;

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
}

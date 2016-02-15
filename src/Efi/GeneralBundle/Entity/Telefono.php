<?php

namespace Efi\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Telefono
 *
 * @ORM\Table(name="telefonos", indexes={@ORM\Index(name="fk_TELEFONOS_PAISES1_idx", columns={"PAI_ID"}), @ORM\Index(name="fk_TELEFONOS_VALORESVARIABLES1_idx", columns={"VVA_IDTIPO"})})
 * @ORM\Entity
 */
class Telefono
{
    /**
     * @var integer
     *
     * @ORM\Column(name="TLF_ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="TLF_TIPO", type="integer", nullable=false)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="TLF_NUMEROTELEFONICO", type="string", length=20, nullable=false)
     */
    private $numeroTelefonico;

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
     *   @ORM\JoinColumn(name="VVA_IDTIPO", referencedColumnName="VVA_ID")
     * })
     */
    private $idTipo;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="\Efi\GanadosBundle\Entity\Persona", mappedBy="telefonos")
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
     * @return int
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * @param int $tipo
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    /**
     * @return string
     */
    public function getNumeroTelefonico()
    {
        return $this->numeroTelefonico;
    }

    /**
     * @param string $numeroTelefonico
     */
    public function setNumeroTelefonico($numeroTelefonico)
    {
        $this->numeroTelefonico = $numeroTelefonico;
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
     * @return \Efi\GeneralBundle\Entity\ValorVariable
     */
    public function getIdTipo()
    {
        return $this->idTipo;
    }

    /**
     * @param \Efi\GeneralBundle\Entity\ValorVariable $idTipo
     */
    public function setIdTipo($idTipo)
    {
        $this->idTipo = $idTipo;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPersonas()
    {
        return $this->personas;
    }

    /**
     * @param \Doctrine\Common\Collections\Collection $personas
     */
    public function setPersonas($personas)
    {
        $this->personas = $personas;
    }


}


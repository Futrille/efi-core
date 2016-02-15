<?php

namespace Iglesys\Bundle\GeneralBundle\Entity;

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
     * @var Pais
     *
     * @ORM\ManyToOne(targetEntity="Pais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="PAI_ID", referencedColumnName="PAI_ID")
     * })
     */
    private $pais;

    /**
     * @var ValorVariable
     *
     * @ORM\ManyToOne(targetEntity="ValorVariable")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="VVA_IDTIPO", referencedColumnName="VVA_ID")
     * })
     */
    private $vvaTipo;

//    /**
//     * @var \Doctrine\Common\Collections\Collection
//     *
//     * @ORM\ManyToMany(targetEntity="Lideres", mappedBy="tlf")
//     */
//    private $lideres;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="\Iglesys\Bundle\GanadosBundle\Entity\Persona", mappedBy="telefonos")
     */
    private $personas;

    /**
     * Constructor
     */
    public function __construct()
    {
//        $this->lideres = new \Doctrine\Common\Collections\ArrayCollection();
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

    /**
     * @return ValorVariable
     */
    public function getVvaTipo()
    {
        return $this->vvaTipo;
    }

    /**
     * @param ValorVariable $vvaTipo
     */
    public function setVvaTipo($vvaTipo)
    {
        $this->vvaTipo = $vvaTipo;
    }

//    /**
//     * @return \Doctrine\Common\Collections\Collection
//     */
//    public function getLideres()
//    {
//        return $this->lideres;
//    }
//
//    /**
//     * @param \Doctrine\Common\Collections\Collection $lideres
//     */
//    public function setLideres($lideres)
//    {
//        $this->lideres = $lideres;
//    }

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


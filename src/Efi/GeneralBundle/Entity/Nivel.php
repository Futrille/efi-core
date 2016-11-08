<?php

namespace Efi\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nivel
 *
 * @ORM\Table(name="niveles", indexes={@ORM\Index(name="fk_NIVELES_VALORES_VARIABLES1_idx", columns={"VVA_IDTIPO"}), @ORM\Index(name="fk_NIVELES_VALORES_VARIABLES2_idx", columns={"VVA_IDESTATUS"}), @ORM\Index(name="fk_NIVELES_NIVELES1_idx", columns={"NIV_IDPADRE"}), @ORM\Index(name="fk_NIVELES_IGLESIAS1_idx", columns={"IGL_ID"}), @ORM\Index(name="fk_NIVELES_VALORES_VARIABLES3_idx", columns={"VVA_IDICONO"})})
 * @ORM\Entity
 */
class Nivel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="NIV_ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="NIV_TIPO", type="integer", nullable=false)
     */
    private $tipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="NIV_ESTATUS", type="integer", nullable=false)
     */
    private $estatus;

    /**
     * @var integer
     *
     * @ORM\Column(name="NIV_ICONO", type="integer", nullable=false)
     */
    private $icono;

    /**
     * @var string
     *
     * @ORM\Column(name="NIV_NOMBRE", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="NIV_COLOR", type="string", length=10, nullable=false)
     */
    private $color;

    /**
     * @var \Efi\GeneralBundle\Entity\Iglesia
     *
     * @ORM\ManyToOne(targetEntity="Efi\GeneralBundle\Entity\Iglesia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IGL_ID", referencedColumnName="IGL_ID")
     * })
     */
    private $iglesia;

    /**
     * @var \Efi\GeneralBundle\Entity\Nivel
     *
     * @ORM\ManyToOne(targetEntity="Efi\GeneralBundle\Entity\Nivel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="NIV_IDPADRE", referencedColumnName="NIV_ID")
     * })
     */
    private $padre;

    /**
     * @var \Efi\GeneralBundle\Entity\ValorVariable
     *
     * @ORM\ManyToOne(targetEntity="Efi\GeneralBundle\Entity\ValorVariable")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="VVA_IDTIPO", referencedColumnName="VVA_ID")
     * })
     */
    private $idTipo;

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
     *   @ORM\JoinColumn(name="VVA_IDICONO", referencedColumnName="VVA_ID")
     * })
     */
    private $idIcono;

    /**
     * @var string
     *
     * @ORM\Column(name="NIV_ORDEN", type="integer", nullable=false)
     */
    private $orden;

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
    public function getIcono()
    {
        return $this->icono;
    }

    /**
     * @param int $icono
     */
    public function setIcono($icono)
    {
        $this->icono = $icono;
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
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param string $color
     */
    public function setColor($color)
    {
        $this->color = $color;
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
     * @return Nivel
     */
    public function getPadre()
    {
        return $this->padre;
    }

    /**
     * @param Nivel $padre
     */
    public function setPadre($padre)
    {
        $this->padre = $padre;
    }

    /**
     * @return ValorVariable
     */
    public function getIdTipo()
    {
        return $this->idTipo;
    }

    /**
     * @param ValorVariable $idTipo
     */
    public function setIdTipo($idTipo)
    {
        $this->idTipo = $idTipo;
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
    public function getIdIcono()
    {
        return $this->idIcono;
    }

    /**
     * @param ValorVariable $idIcono
     */
    public function setIdIcono($idIcono)
    {
        $this->idIcono = $idIcono;
    }

    /**
     * @return string
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * @param string $orden
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;
    }


}

<?php

namespace Efi\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Nivel
 *
 * @ORM\Table(name="nivel")
 * @ORM\Entity(repositoryClass="Efi\GeneralBundle\Repository\NivelRepository")
 */
class Nivel
{
    /**
     * @var int
     *
     * @ORM\Column(name="NIV_ID", type="integer", nulleable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="NIV_TIPO", type="integer", nulleable=false)
    */
    private $tipo;

    /**
     * @var int
     *
     * ORM\Column(name="NIV_ESTATUS", type="integer", nulleable=false)
    */
    private $estatus;

    /**
     * @var int
     *
     * ORM\Column(name="NIV_ICONO", type="integer", nulleable=false)
     */
    private $icono;

    /**
     * @var string
     *
     * ORM\Column(name="NIV_NOMBRE", type="string", length=50, nulleable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * ORM\Column(name="NIV_COLOR", type="string", length=10, nulleable=false)
     */
    private $color;

    /**
     * @var \Efi\GeneralBundle\Entity\Nivel
     *
     * @ORM\OneToMany(targetEntity="Efi\GeneralBundle\Entity\Nivel")
     * @ORM\JoinColumns({
     *     @ORM\JoinColumn(name="NIV_PADRE", referencedColumnName="NIV_ID")
     * })
    */
    private $idPadre;

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
     * @return integer
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
     * @return int
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param int $nombre
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * @return int
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param int $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @return integer
     */
    public function getPadre()
    {
        return $this->idPadre;
    }

    /**
     * @param int $idPadre
     */
    public function setIdPadre($idPadre)
    {
        $this->idPadre = $idPadre;
    }

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
     * @return \Efi\GeneralBundle\Entity\ValorVariable
     */
    public function getIdIcono()
    {
        return $this->idIcono;
    }

    /**
     * @param \Efi\GeneralBundle\Entity\ValorVariable $idIcono
     */
    public function setIdIcono($idIcono)
    {
        $this->idIcono = $idIcono;
    }
}

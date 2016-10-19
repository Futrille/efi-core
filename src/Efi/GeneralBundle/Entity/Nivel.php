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
    private $nivId;

    /**
     * @var integer
     *
     * @ORM\Column(name="NIV_TIPO", type="integer", nullable=false)
     */
    private $nivTipo;

    /**
     * @var integer
     *
     * @ORM\Column(name="NIV_ESTATUS", type="integer", nullable=false)
     */
    private $nivEstatus;

    /**
     * @var integer
     *
     * @ORM\Column(name="NIV_ICONO", type="integer", nullable=false)
     */
    private $nivIcono;

    /**
     * @var string
     *
     * @ORM\Column(name="NIV_NOMBRE", type="string", length=50, nullable=false)
     */
    private $nivNombre;

    /**
     * @var string
     *
     * @ORM\Column(name="NIV_COLOR", type="string", length=10, nullable=false)
     */
    private $nivColor;

    /**
     * @var \Iglesias
     *
     * @ORM\ManyToOne(targetEntity="Iglesia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IGL_ID", referencedColumnName="IGL_ID")
     * })
     */
    //private $igl;

    /**
     * @var \Niveles
     *
     * @ORM\ManyToOne(targetEntity="Nivel")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="NIV_IDPADRE", referencedColumnName="NIV_ID")
     * })
     */
    private $nivPadre;

    /**
     * @var \ValoreVariables
     *
     * @ORM\ManyToOne(targetEntity="ValorVariable")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="VVA_IDTIPO", referencedColumnName="VVA_ID")
     * })
     */
    private $vvaTipo;

    /**
     * @var \ValoreVariables
     *
     * @ORM\ManyToOne(targetEntity="ValorVariable")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="VVA_IDESTATUS", referencedColumnName="VVA_ID")
     * })
     */
    private $vvaEstatus;

    /**
     * @var \ValoreVariables
     *
     * @ORM\ManyToOne(targetEntity="ValorVariable")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="VVA_IDICONO", referencedColumnName="VVA_ID")
     * })
     */
    private $vvaIcono;

    /**
     * @return int
     */
    public function getNivId()
    {
        return $this->nivId;
    }

    /**
     * @param int $nivId
     */
    public function setNivId($nivId)
    {
        $this->nivId = $nivId;
    }

    /**
     * @return int
     */
    public function getNivTipo()
    {
        return $this->nivTipo;
    }

    /**
     * @param int $nivTipo
     */
    public function setNivTipo($nivTipo)
    {
        $this->nivTipo = $nivTipo;
    }

    /**
     * @return int
     */
    public function getNivEstatus()
    {
        return $this->nivEstatus;
    }

    /**
     * @param int $nivEstatus
     */
    public function setNivEstatus($nivEstatus)
    {
        $this->nivEstatus = $nivEstatus;
    }

    /**
     * @return int
     */
    public function getNivIcono()
    {
        return $this->nivIcono;
    }

    /**
     * @param int $nivIcono
     */
    public function setNivIcono($nivIcono)
    {
        $this->nivIcono = $nivIcono;
    }

    /**
     * @return string
     */
    public function getNivNombre()
    {
        return $this->nivNombre;
    }

    /**
     * @param string $nivNombre
     */
    public function setNivNombre($nivNombre)
    {
        $this->nivNombre = $nivNombre;
    }

    /**
     * @return string
     */
    public function getNivColor()
    {
        return $this->nivColor;
    }

    /**
     * @param string $nivColor
     */
    public function setNivColor($nivColor)
    {
        $this->nivColor = $nivColor;
    }

    /**
     * @return \Iglesias
     */
   // public function getIgl()
    //{
      //  return $this->igl;
    //}

    /**
     * @param \Iglesias $igl
     */
   // public function setIgl($igl)
    //{
      //  $this->igl = $igl;
    //}

    /**
     * @return \Niveles
     */
    public function getNivPadre()
    {
        return $this->nivPadre;
    }

    /**
     * @param \Niveles $nivPadre
     */
    public function setNivPadre($nivPadre)
    {
        $this->nivPadre = $nivPadre;
    }

    /**
     * @return \ValoreVariables
     */
    public function getVvaTipo()
    {
        return $this->vvaTipo;
    }

    /**
     * @param \ValoreVariables $vvaTipo
     */
    public function setVvaTipo($vvaTipo)
    {
        $this->vvaTipo = $vvaTipo;
    }

    /**
     * @return \ValoreVariables
     */
    public function getVvaEstatus()
    {
        return $this->vvaEstatus;
    }

    /**
     * @param \ValoreVariables $vvaEstatus
     */
    public function setVvaEstatus($vvaEstatus)
    {
        $this->vvaEstatus = $vvaEstatus;
    }

    /**
     * @return \ValoreVariables
     */
    public function getVvaIcono()
    {
        return $this->vvaIcono;
    }

    /**
     * @param \ValoreVariables $vvaIcono
     */
    public function setVvaIcono($vvaIcono)
    {
        $this->vvaIcono = $vvaIcono;
    }


}

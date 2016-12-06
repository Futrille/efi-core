<?php

namespace Efi\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Iglesia
 *
 * @ORM\Table(name="IGLESIAS", indexes={@ORM\Index(name="fk_IGLESIAS_PAISES1_idx", columns={"PAI_ID"}), @ORM\Index(name="fk_IGLESIAS_VALORES_VARIABLES1_idx", columns={"VVA_IDESTATUS"})})
 * @ORM\Entity
 */
class Iglesia
{
    //Contantes provenientes de VVA_COD = igl_estatus
    const ESTATUS_ACTIVA = 1;
    const ESTATUS_INACTIVA = 2;

    /**
     * @var integer
     *
     * @ORM\Column(name="IGL_ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="IGL_IDPADRE", type="integer", nullable=true)
     */
    private $idPadre;

    /**
     * @var integer
     *
     * @ORM\Column(name="IGL_ESTATUS", type="integer", nullable=false)
     */
    private $estatus;

    /**
     * @var string
     * @Assert\NotBlank(message = "Este campo es obligatorio.")
     * @Assert\Length(
     *      max = 100,
     *      maxMessage = "Solo se permiten {{ limit }} caracteres"
     * )
     *
     * @ORM\Column(name="IGL_NOMBRE", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     * @Assert\NotBlank(message = "Este campo es obligatorio.")
     * @Assert\Length(
     *      max = 10,
     *      maxMessage = "Solo se permiten {{ limit }} caracteres"
     * )
     *
     * @ORM\Column(name="IGL_ABREVIACION", type="string", length=10, nullable=false)
     */
    private $abreviacion;

    /**
     * @var string
     * @Assert\Length(
     *      max = 100,
     *      maxMessage = "Solo se permiten {{ limit }} caracteres"
     * )
     *
     * @ORM\Column(name="IGL_WEB", type="string", length=100, nullable=true)
     */
    private $web;

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
     *   @ORM\JoinColumn(name="VVA_IDESTATUS", referencedColumnName="VVA_ID")
     * })
     */
    private $idEstatus;

    /**
     * @return string
     */
    public function __toString(){
        return $this->getNombre();
    }

    /**
     * Constructor
     */
    public function __construct()
    {
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
    public function getIdPadre()
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
    public function getAbreviacion()
    {
        return $this->abreviacion;
    }

    /**
     * @param string $abreviacion
     */
    public function setAbreviacion($abreviacion)
    {
        $this->abreviacion = $abreviacion;
    }

    /**
     * @return string
     */
    public function getWeb()
    {
        return $this->web;
    }

    /**
     * @param string $web
     */
    public function setWeb($web)
    {
        $this->web = $web;
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

}


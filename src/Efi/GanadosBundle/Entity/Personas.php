<?php

namespace Efi\GanadosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Personas
 *
 * @ORM\Table(name="personas", indexes={@ORM\Index(name="fk_PERSONAS_PAISES1_idx", columns={"PAI_ID"}), @ORM\Index(name="fk_PERSONAS_VALORESVARIABLES1_idx", columns={"VVA_IDESTATUS"}), @ORM\Index(name="fk_PERSONAS_VALORESVARIABLES2_idx", columns={"VVA_IDESCOMPLETO"}), @ORM\Index(name="fk_PERSONAS_IGLESIAS1_idx", columns={"IGL_ID"}), @ORM\Index(name="fk_PERSONAS_METODOS_GANAR1_idx", columns={"MET_ID"})})
 * @ORM\Entity
 */
class Personas
{
    /**
     * @var integer
     *
     * @ORM\Column(name="PER_ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $perId;

    /**
     * @var integer
     *
     * @ORM\Column(name="PER_ESTATUS", type="integer", nullable=false)
     */
    private $perEstatus;

    /**
     * @var integer
     *
     * @ORM\Column(name="PER_ESCOMPLETO", type="integer", nullable=false)
     */
    private $perEscompleto;

    /**
     * @var integer
     *
     * @ORM\Column(name="PER_FECHANACIMIENTO", type="integer", nullable=false)
     */
    private $perFechanacimiento;

    /**
     * @var string
     *
     * @ORM\Column(name="PER_CEDULA", type="string", length=20, nullable=true)
     */
    private $perCedula;

    /**
     * @var string
     *
     * @ORM\Column(name="PER_NACIONALIDAD", type="string", length=1, nullable=false)
     */
    private $perNacionalidad;

    /**
     * @var string
     *
     * @ORM\Column(name="PER_NOMBRES", type="string", length=100, nullable=false)
     */
    private $perNombres;

    /**
     * @var string
     *
     * @ORM\Column(name="PER_APELLIDOS", type="string", length=100, nullable=false)
     */
    private $perApellidos;

    /**
     * @var string
     *
     * @ORM\Column(name="PER_SEXO", type="string", length=1, nullable=false)
     */
    private $perSexo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="PER_CREATED_AT", type="datetime", nullable=false)
     */
    private $perCreatedAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="PER UPDATED_AT", type="datetime", nullable=false)
     */
    private $perUpdatedAt;

    /**
     * @var \Paises
     *
     * @ORM\ManyToOne(targetEntity="Paises")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="PAI_ID", referencedColumnName="PAI_ID")
     * })
     */
    private $pai;

    /**
     * @var \ValoresVariables
     *
     * @ORM\ManyToOne(targetEntity="ValoresVariables")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="VVA_IDESTATUS", referencedColumnName="VVA_ID")
     * })
     */
    private $vvaestatus;

    /**
     * @var \ValoresVariables
     *
     * @ORM\ManyToOne(targetEntity="ValoresVariables")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="VVA_IDESCOMPLETO", referencedColumnName="VVA_ID")
     * })
     */
    private $vvaescompleto;

    /**
     * @var \Iglesias
     *
     * @ORM\ManyToOne(targetEntity="Iglesias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="IGL_ID", referencedColumnName="IGL_ID")
     * })
     */
    private $igl;

    /**
     * @var \MetodosGanar
     *
     * @ORM\ManyToOne(targetEntity="MetodosGanar")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="MET_ID", referencedColumnName="MET_ID")
     * })
     */
    private $met;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Direcciones", inversedBy="per")
     * @ORM\JoinTable(name="personas_has_direcciones",
     *   joinColumns={
     *     @ORM\JoinColumn(name="PER_ID", referencedColumnName="PER_ID")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="DIR_ID", referencedColumnName="DIR_ID")
     *   }
     * )
     */
    private $dir;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Telefonos", inversedBy="per")
     * @ORM\JoinTable(name="personas_has_telefonos",
     *   joinColumns={
     *     @ORM\JoinColumn(name="PER_ID", referencedColumnName="PER_ID")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="TLF_ID", referencedColumnName="TLF_ID")
     *   }
     * )
     */
    private $tlf;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dir = new \Doctrine\Common\Collections\ArrayCollection();
        $this->tlf = new \Doctrine\Common\Collections\ArrayCollection();
    }

}

<?php

namespace Efi\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \Efi\GeneralBundle\Entity\ValorVariable as ValorVariable;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Usuarios
 *
 * @ORM\Table(name="usuarios", indexes={@ORM\Index(name="fk_USUARIOS_VALORESVARIABLES1_idx", columns={"VVA_IDESTATUS"}), @ORM\Index(name="fk_USUARIOS_LIDERES1_idx", columns={"LID_ID"})})
 * @ORM\Entity
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="USU_ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="USU_ESTATUS", type="integer", nullable=false)
     */
    private $estatus;

    /**
     * @var string
     *
     * @ORM\Column(name="USU_LOGIN", type="string", length=30, nullable=false, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="USU_PASSWORD", type="string", length=250, nullable=false)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="USU_NOMBRE", type="string", length=50, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="USU_APELLIDO", type="string", length=50, nullable=false)
     */
    private $apellido;

    /**
     * @var string
     *
     * @ORM\Column(name="USU_EMAIL", type="string", length=100, nullable=false, unique=true)
     */
    private $email;

    /**
     * @var integer
     *
     * @ORM\Column(name="USU_FECHAEXPIRACION", type="integer", nullable=false)
     */
    private $fechaExpiracion;

    /**
     * @var integer
     *
     * @ORM\Column(name="USU_FECHAEXPIRACIONPASSWORD", type="integer", nullable=false)
     */
    private $fechaExpiracionPassword;

//    /**
//     * @var \Lideres
//     *
//     * @ORM\ManyToOne(targetEntity="Lideres")
//     * @ORM\JoinColumns({
//     *   @ORM\JoinColumn(name="LID_ID", referencedColumnName="LID_ID")
//     * })
//     */
//    private $lid;

    /**
     * @var \Efi\GeneralBundle\Entity\ValorVariable
     *
     * @ORM\ManyToOne(targetEntity="Efi\GeneralBundle\Entity\ValorVariable")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="VVA_IDESTATUS", referencedColumnName="VVA_ID")
     * })
     */
    private $idEstatus;

//    /**
//     * @var \Doctrine\Common\Collections\Collection
//     *
//     * @ORM\ManyToMany(targetEntity="Roles", inversedBy="usu")
//     * @ORM\JoinTable(name="usuarios_has_roles",
//     *   joinColumns={
//     *     @ORM\JoinColumn(name="USU_ID", referencedColumnName="USU_ID")
//     *   },
//     *   inverseJoinColumns={
//     *     @ORM\JoinColumn(name="ROL_ID", referencedColumnName="ROL_ID")
//     *   }
//     * )
//     */
//    private $rol;

    /**
     * Constructor
     */
    public function __construct()
    {
//        $this->rol = new \Doctrine\Common\Collections\ArrayCollection();
    }


}

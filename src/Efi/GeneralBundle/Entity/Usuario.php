<?php

namespace Efi\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Usuario
 *
 * @ORM\Table(name="usuarios", indexes={@ORM\Index(name="fk_USUARIOS_VALORESVARIABLES1_idx", columns={"VVA_IDESTATUS"}), @ORM\Index(name="fk_USUARIOS_LIDERES1_idx", columns={"LID_ID"})})
 * @ORM\Entity
 */
class Usuario implements UserInterface, \Serializable
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
     * @ORM\Column(name="USU_EMAIL", type="string", length=100, nullable=false)
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

    /**
     * @var integer
     */
    private $isActive;

//    /**
//     * @var \Lideres
//     *
//     * @ORM\ManyToOne(targetEntity="Lideres")
//     * @ORM\JoinColumns({
//     *   @ORM\JoinColumn(name="LID_ID", referencedColumnName="LID_ID")
//     * })
//     */
//    private $lid;

//    /**
//     * @var \ValoresVariables
//     *
//     * @ORM\ManyToOne(targetEntity="ValoresVariables")
//     * @ORM\JoinColumns({
//     *   @ORM\JoinColumn(name="VVA_IDESTATUS", referencedColumnName="VVA_ID")
//     * })
//     */
//    private $vvaEstatus;

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
        $this->isActive = true;
        // may not be needed, see section on salt below
        // $this->salt = md5(uniqid(null, true));
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
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getSalt()
    {
        // you *may* need a real salt depending on your encoder
        // see section on salt below
        return null;
    }

    public function getRoles()
    {
        return array('ROLE_ADMIN');
    }

    public function eraseCredentials()
    {
    }

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
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
    public function getApellido()
    {
        return $this->apellido;
    }

    /**
     * @param string $apellido
     */
    public function setApellido($apellido)
    {
        $this->apellido = $apellido;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getFechaExpiracion()
    {
        return $this->fechaExpiracion;
    }

    /**
     * @param int $fechaExpiracion
     */
    public function setFechaExpiracion($fechaExpiracion)
    {
        $this->fechaExpiracion = $fechaExpiracion;
    }

    /**
     * @return int
     */
    public function getFechaExpiracionPassword()
    {
        return $this->fechaExpiracionPassword;
    }

    /**
     * @param int $fechaExpiracionPassword
     */
    public function setFechaExpiracionPassword($fechaExpiracionPassword)
    {
        $this->fechaExpiracionPassword = $fechaExpiracionPassword;
    }

    /**
     * @return int
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * @param int $isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    }


}


<?php

namespace Efi\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Estado
 *
 * @ORM\Table(name="ESTADOS", indexes={@ORM\Index(name="fk_ESTADOS_PAISES_idx", columns={"PAI_ID"})})
 * @ORM\Entity
 */
class Estado
{
    /**
     * @var integer
     *
     * @ORM\Column(name="EDO_ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="EDO_NOMBRE", type="string", length=100, nullable=false)
     */
    private $nombre;

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
        
        return $this;
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

        return $this;
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

        return $this;
    }


}


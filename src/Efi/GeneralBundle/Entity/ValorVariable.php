<?php

namespace Efi\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ValorVariable
 *
 * @ORM\Table(name="valores_variables")
 * @ORM\Entity
 */
class ValorVariable
{
    /**
     * @var integer
     *
     * @ORM\Column(name="VVA_ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="VVA_CODIGO", type="string", length=20, nullable=false)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="VVA_VALOR", type="string", length=20, nullable=false)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="VVA_NOMBRE", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var integer
     *
     * @ORM\Column(name="VVA_ORDEN", type="integer", nullable=false)
     */
    private $orden;

    /**
     * @var string
     *
     * @ORM\Column(name="VVA_DESCRIPCION", type="string", length=500, nullable=false)
     */
    private $descripcion;

    /**
     * @return string
     */
    public function __toString(){
        return $this->getNombre();
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
     * @return string
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param string $codigo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    /**
     * @return string
     */
    public function getValor()
    {
        return $this->valor;
    }

    /**
     * @param string $valor
     */
    public function setValor($valor)
    {
        $this->valor = $valor;
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
     * @return int
     */
    public function getOrden()
    {
        return $this->orden;
    }

    /**
     * @param int $orden
     */
    public function setOrden($orden)
    {
        $this->orden = $orden;
    }

    /**
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param string $descripcion
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }


}

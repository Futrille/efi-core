<?php

namespace Efi\GeneralBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ParametrosGenerales
 *
 * @ORM\Table(name="parametros_generales")
 * @ORM\Entity
 */
class ParametroGeneral
{
    /**
     * @var integer
     *
     * @ORM\Column(name="PMT_ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="PMT_CODIGO", type="string", length=20, nullable=false)
     */
    private $codigo;

    /**
     * @var string
     *
     * @ORM\Column(name="PMT_VALOR", type="string", length=250, nullable=false)
     */
    private $valor;

    /**
     * @var string
     *
     * @ORM\Column(name="PMT_DESCRIPCION", type="string", length=500, nullable=false)
     */
    private $descripcion;

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


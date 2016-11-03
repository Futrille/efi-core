<?php

namespace Efi\GanadosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Familias
 *
 * @ORM\Table(name="familias", indexes={@ORM\Index(name="fk_FAMILIAS_ESTADOS1_idx", columns={"EDO_ID"}), @ORM\Index(name="fk_FAMILIAS_MUNICIPIOS1_idx", columns={"MCP_ID"}), @ORM\Index(name="fk_FAMILIAS_PAREJAS_MINISTERIALES1_idx", columns={"PMI_ID"})})
 * @ORM\Entity
 */
class Familias
{
    /**
     * @var integer
     *
     * @ORM\Column(name="FAM_ID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $famId;

    /**
     * @var string
     *
     * @ORM\Column(name="PMI_CODIGO", type="string", length=50, nullable=false)
     */
    private $pmiCodigo;

    /**
     * @var string
     *
     * @ORM\Column(name="FAM_NOMBRE", type="string", length=50, nullable=false)
     */
    private $famNombre;

    /**
     * @var string
     *
     * @ORM\Column(name="FAM_DIRECCION", type="string", length=500, nullable=false)
     */
    private $famDireccion;

    /**
     * @var \Estados
     *
     * @ORM\ManyToOne(targetEntity="Estados")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="EDO_ID", referencedColumnName="EDO_ID")
     * })
     */
    private $edo;

    /**
     * @var \Municipios
     *
     * @ORM\ManyToOne(targetEntity="Municipios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="MCP_ID", referencedColumnName="MCP_ID")
     * })
     */
    private $mcp;

    /**
     * @var \ParejasMinisteriales
     *
     * @ORM\ManyToOne(targetEntity="ParejasMinisteriales")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="PMI_ID", referencedColumnName="PMI_ID")
     * })
     */
    private $pmi;


}

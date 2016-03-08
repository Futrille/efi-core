<?php

namespace Efi\GeneralBundle\Entity;


/**
 * Login
 */
class Login
{
    private $cedula;

    private $contrasena;

    /**
     * Set cedula
     *
     * @param integer $cedula
     * @return Login
     */
    public function setCedula($cedula)
    {
        $this->cedula = $cedula;

        return $this;
    }

    /**
     * Get cedula
     *
     * @return integer 
     */
    public function getCedula()
    {
        return $this->cedula;
    }

    /**
     * Set contrasena
     *
     * @param string $contrasena
     * @return Login
     */
    public function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;

        return $this;
    }

    /**
     * Get contrasena
     *
     * @return string 
     */
    public function getContrasena()
    {
        return $this->contrasena;
    }
}

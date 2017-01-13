<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TipoEntidad
 *
 * @ORM\Table(name="tipo_entidad")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TipoEntidadRepository")
 */
class TipoEntidad
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=255)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="idTipo", type="string", length=10)
     */
    private $idTipo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="current", type="date")
     */
    private $current;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set tipo
     *
     * @param string $tipo
     *
     * @return TipoEntidad
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Get tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set idTipo
     *
     * @param string $idTipo
     *
     * @return TipoEntidad
     */
    public function setIdTipo($idTipo)
    {
        $this->idTipo = $idTipo;

        return $this;
    }

    /**
     * Get idTipo
     *
     * @return string
     */
    public function getIdTipo()
    {
        return $this->idTipo;
    }

    /**
     * Set current
     *
     * @param \DateTime $current
     *
     * @return TipoEntidad
     */
    public function setCurrent($current)
    {
        $this->current = $current;

        return $this;
    }

    /**
     * Get current
     *
     * @return \DateTime
     */
    public function getCurrent()
    {
        return $this->current;
    }
}

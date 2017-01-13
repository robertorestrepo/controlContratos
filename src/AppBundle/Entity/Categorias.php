<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Categorias
 *
 * @ORM\Table(name="categorias")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CategoriasRepository")
 */
class Categorias
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
     * @ORM\Column(name="nombre", type="string", length=255)
     */
    private $nombre;
    
    /**
     * @ORM\OneToMany(targetEntity="Contrato", mappedBy="categorias")
     */
    private $contrato;
    
    public function __construct()
    {
    $this->products = new ArrayCollection();
    }


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
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Categorias
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Add contrato
     *
     * @param \AppBundle\Entity\Contrato $contrato
     *
     * @return Categorias
     */
    public function addContrato(\AppBundle\Entity\Contrato $contrato)
    {
        $this->contrato[] = $contrato;

        return $this;
    }

    /**
     * Remove contrato
     *
     * @param \AppBundle\Entity\Contrato $contrato
     */
    public function removeContrato(\AppBundle\Entity\Contrato $contrato)
    {
        $this->contrato->removeElement($contrato);
    }

    /**
     * Get contrato
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContrato()
    {
        return $this->contrato;
    }
}

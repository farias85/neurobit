<?php

namespace NB\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Procedencia
 *
 * @ORM\Table(name="procedencia")
 * @ORM\Entity
 */
class Procedencia {
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=true)
     */
    private $descripcion;

    /**
     * @var bool
     *
     * @ORM\Column(name="fuera_provincia", type="boolean", nullable=false)
     */
    private $fueraProvincia;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set nombre.
     *
     * @param string $nombre
     *
     * @return Procedencia
     */
    public function setNombre($nombre) {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre.
     *
     * @return string
     */
    public function getNombre() {
        return $this->nombre;
    }

    /**
     * Set descripcion.
     *
     * @param string|null $descripcion
     *
     * @return Procedencia
     */
    public function setDescripcion($descripcion = null) {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion.
     *
     * @return string|null
     */
    public function getDescripcion() {
        return $this->descripcion;
    }

    /**
     * Set fueraProvincia.
     *
     * @param bool $fueraProvincia
     *
     * @return Procedencia
     */
    public function setFueraProvincia($fueraProvincia) {
        $this->fueraProvincia = $fueraProvincia;

        return $this;
    }

    /**
     * Get fueraProvincia.
     *
     * @return bool
     */
    public function getFueraProvincia() {
        return $this->fueraProvincia;
    }
}

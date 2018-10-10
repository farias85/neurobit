<?php

namespace NB\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Paciente
 *
 * @ORM\Table(name="paciente")
 * @ORM\Entity
 */
class Paciente {
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
     * @ORM\Column(name="ci", type="string", length=11, nullable=false)
     */
    private $ci;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=100, nullable=false)
     */
    private $nombre;

    /**
     * @var bool
     *
     * @ORM\Column(name="sexo", type="boolean", nullable=false)
     */
    private $sexo;

    /**
     * @var int
     *
     * @ORM\Column(name="edad", type="integer", nullable=false)
     */
    private $edad;

    /**
     * @var bool
     *
     * @ORM\Column(name="ingresado", type="boolean", nullable=false)
     */
    private $ingresado;

    /**
     * @var Procedencia
     *
     * @ORM\ManyToOne(targetEntity="Procedencia")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="procedencia", referencedColumnName="id")
     * })
     */
    private $procedencia;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set ci.
     *
     * @param string $ci
     *
     * @return Paciente
     */
    public function setCi($ci) {
        $this->ci = $ci;

        return $this;
    }

    /**
     * Get ci.
     *
     * @return string
     */
    public function getCi() {
        return $this->ci;
    }

    /**
     * Set nombre.
     *
     * @param string $nombre
     *
     * @return Paciente
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
     * Set sexo.
     *
     * @param bool $sexo
     *
     * @return Paciente
     */
    public function setSexo($sexo) {
        $this->sexo = $sexo;

        return $this;
    }

    /**
     * Get sexo.
     *
     * @return bool
     */
    public function getSexo() {
        return $this->sexo;
    }

    /**
     * Set edad.
     *
     * @param int $edad
     *
     * @return Paciente
     */
    public function setEdad($edad) {
        $this->edad = $edad;

        return $this;
    }

    /**
     * Get edad.
     *
     * @return int
     */
    public function getEdad() {
        return $this->edad;
    }

    /**
     * Set ingresado.
     *
     * @param bool $ingresado
     *
     * @return Paciente
     */
    public function setIngresado($ingresado) {
        $this->ingresado = $ingresado;

        return $this;
    }

    /**
     * Get ingresado.
     *
     * @return bool
     */
    public function getIngresado() {
        return $this->ingresado;
    }

    /**
     * Set procedencia.
     *
     * @param \NB\CommonBundle\Entity\Procedencia|null $procedencia
     *
     * @return Paciente
     */
    public function setProcedencia(\NB\CommonBundle\Entity\Procedencia $procedencia = null) {
        $this->procedencia = $procedencia;

        return $this;
    }

    /**
     * Get procedencia.
     *
     * @return \NB\CommonBundle\Entity\Procedencia|null
     */
    public function getProcedencia() {
        return $this->procedencia;
    }
}

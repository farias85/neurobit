<?php

namespace NB\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TurnoIndicacion
 *
 * @ORM\Table(name="turno_indicacion")
 * @ORM\Entity
 */
class TurnoIndicacion {

    /**
     * @var Turno
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Turno")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="turno", referencedColumnName="id", nullable=false)
     * })
     */
    private $turno;

    /**
     * @var Indicacion
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Indicacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="indicacion", referencedColumnName="id", nullable=false)
     * })
     */
    private $indicacion;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_real", type="datetime", nullable=false)
     */
    private $fechaReal;

    /**
     * @var string|null
     *
     * @ORM\Column(name="descripcion", type="text", length=65535, nullable=true)
     */
    private $descripcion;


    /**
     * Set fechaReal.
     *
     * @param \DateTime $fechaReal
     *
     * @return TurnoIndicacion
     */
    public function setFechaReal($fechaReal) {
        $this->fechaReal = $fechaReal;

        return $this;
    }

    /**
     * Get fechaReal.
     *
     * @return \DateTime
     */
    public function getFechaReal() {
        return $this->fechaReal;
    }

    /**
     * Set descripcion.
     *
     * @param string|null $descripcion
     *
     * @return TurnoIndicacion
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
     * Set turno.
     *
     * @param \NB\CommonBundle\Entity\Turno $turno
     *
     * @return TurnoIndicacion
     */
    public function setTurno(\NB\CommonBundle\Entity\Turno $turno) {
        $this->turno = $turno;

        return $this;
    }

    /**
     * Get turno.
     *
     * @return \NB\CommonBundle\Entity\Turno
     */
    public function getTurno() {
        return $this->turno;
    }

    /**
     * Set indicacion.
     *
     * @param \NB\CommonBundle\Entity\Indicacion $indicacion
     *
     * @return TurnoIndicacion
     */
    public function setIndicacion(\NB\CommonBundle\Entity\Indicacion $indicacion) {
        $this->indicacion = $indicacion;

        return $this;
    }

    /**
     * Get indicacion.
     *
     * @return \NB\CommonBundle\Entity\Indicacion
     */
    public function getIndicacion() {
        return $this->indicacion;
    }
}

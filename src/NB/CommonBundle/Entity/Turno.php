<?php

namespace NB\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Turno
 *
 * @ORM\Table(name="turno")
 * @ORM\Entity
 */
class Turno {
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_inicio", type="time", nullable=false)
     */
    private $horaInicio;

    /**
     * @var Planificacion
     *
     * @ORM\ManyToOne(targetEntity="Planificacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="planificacion", referencedColumnName="id")
     * })
     */
    private $planificacion;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set horaInicio.
     *
     * @param \DateTime $horaInicio
     *
     * @return Turno
     */
    public function setHoraInicio($horaInicio) {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    /**
     * Get horaInicio.
     *
     * @return \DateTime
     */
    public function getHoraInicio() {
        return $this->horaInicio;
    }

    /**
     * Set planificacion.
     *
     * @param \NB\CommonBundle\Entity\Planificacion|null $planificacion
     *
     * @return Turno
     */
    public function setPlanificacion(\NB\CommonBundle\Entity\Planificacion $planificacion = null) {
        $this->planificacion = $planificacion;

        return $this;
    }

    /**
     * Get planificacion.
     *
     * @return \NB\CommonBundle\Entity\Planificacion|null
     */
    public function getPlanificacion() {
        return $this->planificacion;
    }
}

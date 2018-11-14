<?php

namespace NB\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Planificacion
 *
 * @ORM\Table(name="planificacion")
 * @ORM\Entity
 */
class Planificacion
{
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
     * @ORM\Column(name="fecha", type="date", nullable=false)
     */
    private $fecha;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_inicio", type="time", nullable=false)
     */
    private $horaInicio;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora_fin", type="time", nullable=false)
     */
    private $horaFin;

    /**
     * @var Asignacion
     *
     * @ORM\ManyToOne(targetEntity="Asignacion")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="asignacion", referencedColumnName="id")
     * })
     */
    private $asignacion;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fecha.
     *
     * @param \DateTime $fecha
     *
     * @return Planificacion
     */
    public function setFecha($fecha)
    {
        $this->fecha = $fecha;

        return $this;
    }

    /**
     * Get fecha.
     *
     * @return \DateTime
     */
    public function getFecha()
    {
        return $this->fecha->format('Y-m-d');
    }

    /**
     * Set horaInicio.
     *
     * @param \DateTime $horaInicio
     *
     * @return Planificacion
     */
    public function setHoraInicio($horaInicio)
    {
        $this->horaInicio = $horaInicio;

        return $this;
    }

    /**
     * Get horaInicio.
     *
     * @return \DateTime
     */
    public function getHoraInicio()
    {
        return $this->horaInicio;
    }

    /**
     * Set horaFin.
     *
     * @param \DateTime $horaFin
     *
     * @return Planificacion
     */
    public function setHoraFin($horaFin)
    {
        $this->horaFin = $horaFin;

        return $this;
    }

    /**
     * Get horaFin.
     *
     * @return \DateTime
     */
    public function getHoraFin()
    {
        return $this->horaFin;
    }

    /**
     * Set asignacion.
     *
     * @param \NB\CommonBundle\Entity\Asignacion|null $asignacion
     *
     * @return Planificacion
     */
    public function setAsignacion(\NB\CommonBundle\Entity\Asignacion $asignacion = null)
    {
        $this->asignacion = $asignacion;

        return $this;
    }

    /**
     * Get asignacion.
     *
     * @return \NB\CommonBundle\Entity\Asignacion|null
     */
    public function getAsignacion()
    {
        return $this->asignacion;
    }
}

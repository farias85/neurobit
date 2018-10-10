<?php

namespace NB\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Solicitud
 *
 * @ORM\Table(name="solicitud")
 * @ORM\Entity
 */
class Solicitud {
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
     * @ORM\Column(name="especialista", type="string", length=100, nullable=false)
     */
    private $especialista;

    /**
     * @var string
     *
     * @ORM\Column(name="motivo_consulta", type="string", length=100, nullable=false)
     */
    private $motivoConsulta;

    /**
     * @var string
     *
     * @ORM\Column(name="impresion_diagnostica", type="text", length=65535, nullable=false)
     */
    private $impresionDiagnostica;

    /**
     * @var string|null
     *
     * @ORM\Column(name="sintomas", type="text", length=65535, nullable=true)
     */
    private $sintomas;

    /**
     * @var string|null
     *
     * @ORM\Column(name="signos", type="text", length=65535, nullable=true)
     */
    private $signos;

    /**
     * @var Especialidad
     *
     * @ORM\ManyToOne(targetEntity="Especialidad")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="especialidad", referencedColumnName="id")
     * })
     */
    private $especialidad;

    /**
     * @var Paciente
     *
     * @ORM\ManyToOne(targetEntity="Paciente")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="paciente", referencedColumnName="id")
     * })
     */
    private $paciente;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set especialista.
     *
     * @param string $especialista
     *
     * @return Solicitud
     */
    public function setEspecialista($especialista) {
        $this->especialista = $especialista;

        return $this;
    }

    /**
     * Get especialista.
     *
     * @return string
     */
    public function getEspecialista() {
        return $this->especialista;
    }

    /**
     * Set motivoConsulta.
     *
     * @param string $motivoConsulta
     *
     * @return Solicitud
     */
    public function setMotivoConsulta($motivoConsulta) {
        $this->motivoConsulta = $motivoConsulta;

        return $this;
    }

    /**
     * Get motivoConsulta.
     *
     * @return string
     */
    public function getMotivoConsulta() {
        return $this->motivoConsulta;
    }

    /**
     * Set impresionDiagnostica.
     *
     * @param string $impresionDiagnostica
     *
     * @return Solicitud
     */
    public function setImpresionDiagnostica($impresionDiagnostica) {
        $this->impresionDiagnostica = $impresionDiagnostica;

        return $this;
    }

    /**
     * Get impresionDiagnostica.
     *
     * @return string
     */
    public function getImpresionDiagnostica() {
        return $this->impresionDiagnostica;
    }

    /**
     * Set sintomas.
     *
     * @param string|null $sintomas
     *
     * @return Solicitud
     */
    public function setSintomas($sintomas = null) {
        $this->sintomas = $sintomas;

        return $this;
    }

    /**
     * Get sintomas.
     *
     * @return string|null
     */
    public function getSintomas() {
        return $this->sintomas;
    }

    /**
     * Set signos.
     *
     * @param string|null $signos
     *
     * @return Solicitud
     */
    public function setSignos($signos = null) {
        $this->signos = $signos;

        return $this;
    }

    /**
     * Get signos.
     *
     * @return string|null
     */
    public function getSignos() {
        return $this->signos;
    }

    /**
     * Set especialidad.
     *
     * @param \NB\CommonBundle\Entity\Especialidad|null $especialidad
     *
     * @return Solicitud
     */
    public function setEspecialidad(\NB\CommonBundle\Entity\Especialidad $especialidad = null) {
        $this->especialidad = $especialidad;

        return $this;
    }

    /**
     * Get especialidad.
     *
     * @return \NB\CommonBundle\Entity\Especialidad|null
     */
    public function getEspecialidad() {
        return $this->especialidad;
    }

    /**
     * Set paciente.
     *
     * @param \NB\CommonBundle\Entity\Paciente|null $paciente
     *
     * @return Solicitud
     */
    public function setPaciente(\NB\CommonBundle\Entity\Paciente $paciente = null) {
        $this->paciente = $paciente;

        return $this;
    }

    /**
     * Get paciente.
     *
     * @return \NB\CommonBundle\Entity\Paciente|null
     */
    public function getPaciente() {
        return $this->paciente;
    }
}

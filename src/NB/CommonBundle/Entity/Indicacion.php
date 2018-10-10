<?php

namespace NB\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Indicacion
 *
 * @ORM\Table(name="indicacion")
 * @ORM\Entity
 */
class Indicacion {
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Solicitud
     *
     * @ORM\ManyToOne(targetEntity="Solicitud")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="solicitud", referencedColumnName="id")
     * })
     */
    private $solicitud;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set solicitud.
     *
     * @param \NB\CommonBundle\Entity\Solicitud|null $solicitud
     *
     * @return Indicacion
     */
    public function setSolicitud(\NB\CommonBundle\Entity\Solicitud $solicitud = null) {
        $this->solicitud = $solicitud;

        return $this;
    }

    /**
     * Get solicitud.
     *
     * @return \NB\CommonBundle\Entity\Solicitud|null
     */
    public function getSolicitud() {
        return $this->solicitud;
    }
}

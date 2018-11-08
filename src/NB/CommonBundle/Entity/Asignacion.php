<?php

namespace NB\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Asignacion
 *
 * @ORM\Table(name="asignacion")
 * @ORM\Entity
 */
class Asignacion
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
     * @var int
     *
     * @ORM\Column(name="tiempo", type="integer", nullable=false)
     */
    private $tiempo;

    /**
     * @var bool
     *
     * @ORM\Column(name="disponible", type="boolean", nullable=false)
     */
    private $disponible;

    /**
     * @var Equipo
     *
     * @ORM\ManyToOne(targetEntity="Equipo")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="equipo", referencedColumnName="id")
     * })
     */
    private $equipo;

    /**
     * @var Prueba
     *
     * @ORM\ManyToOne(targetEntity="Prueba")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="prueba", referencedColumnName="id")
     * })
     */
    private $prueba;


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
     * Set tiempo.
     *
     * @param int $tiempo
     *
     * @return Asignacion
     */
    public function setTiempo($tiempo)
    {
        $this->tiempo = $tiempo;

        return $this;
    }

    /**
     * Get tiempo.
     *
     * @return int
     */
    public function getTiempo()
    {
        return $this->tiempo;
    }

    /**
     * Set disponible.
     *
     * @param bool $disponible
     *
     * @return Asignacion
     */
    public function setDisponible($disponible)
    {
        $this->disponible = $disponible;

        return $this;
    }

    /**
     * Get disponible.
     *
     * @return bool
     */
    public function getDisponible()
    {
        return $this->disponible;
    }

    /**
     * Set equipo.
     *
     * @param \NB\CommonBundle\Entity\Equipo|null $equipo
     *
     * @return Asignacion
     */
    public function setEquipo(\NB\CommonBundle\Entity\Equipo $equipo = null)
    {
        $this->equipo = $equipo;

        return $this;
    }

    /**
     * Get equipo.
     *
     * @return \NB\CommonBundle\Entity\Equipo|null
     */
    public function getEquipo()
    {
        return $this->equipo;
    }

    /**
     * Set prueba.
     *
     * @param \NB\CommonBundle\Entity\Prueba|null $prueba
     *
     * @return Asignacion
     */
    public function setPrueba(\NB\CommonBundle\Entity\Prueba $prueba = null)
    {
        $this->prueba = $prueba;

        return $this;
    }

    /**
     * Get prueba.
     *
     * @return \NB\CommonBundle\Entity\Prueba|null
     */
    public function getPrueba()
    {
        return $this->prueba;
    }

    public function __toString()
    {
        return $this->prueba . " - " . $this->equipo;// TODO: Implement __toString() method.
    }
}

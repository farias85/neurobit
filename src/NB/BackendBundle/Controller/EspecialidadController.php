<?php

namespace NB\BackendBundle\Controller;

use NB\CommonBundle\Controller\NomenclatureController;
use NB\CommonBundle\Entity\Especialidad;
use NB\CommonBundle\Util\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Especialidad controller.
 *
 */
class EspecialidadController extends NomenclatureController
{

    /**
     * ¿Cómo desea nombrar la página?
     * @return string
     */
    public function getTitle()
    {
        // TODO: Implement getTitle() method.
        return 'Especialidad';
    }

    public function getEntityName()
    {
        // TODO: Implement getEntityName() method.
        return Entity::ESPECIALIDAD;
    }

    /**
     * El prefijo de las rutas del CRUD q genera symfony
     * @return string
     */
    public function getRoutePrefix()
    {
        // TODO: Implement getRoutePrefix() method.
        return 'backend_especialidad';
    }
}

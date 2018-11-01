<?php

namespace NB\BackendBundle\Controller;

use NB\CommonBundle\Controller\NomenclatureController;
use NB\CommonBundle\Entity\Prueba;
use NB\CommonBundle\Util\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Prueba controller.
 *
 */
class PruebaController extends NomenclatureController {

    /**
     * ¿Cómo desea nombrar la página?
     * @return string
     */
    public function getTitle() {
        return 'Prueba';
    }

    public function getEntityName() {
        return Entity::PRUEBA;
    }

    /**
     * El prefijo de las rutas del CRUD q genera symfony
     * @return string
     */
    public function getRoutePrefix() {
        return 'backend_prueba';
    }
}
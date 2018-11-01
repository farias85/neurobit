<?php
/**
 * Created by PhpStorm.
 * User: farias
 * Date: 11/1/2018
 * Time: 10:50 AM
 */

namespace NB\BackendBundle\Controller;


use NB\CommonBundle\Controller\NomenclatureController;
use NB\CommonBundle\Util\Entity;

class EquipoNController extends NomenclatureController {

    /**
     * ¿Cómo desea nombrar la página?
     * @return string
     */
    public function getTitle() {
        return 'Equipo';
    }

    public function getEntityName() {
        return Entity::EQUIPO;
    }

    /**
     * El prefijo de las rutas del CRUD q genera symfony
     * @return string
     */
    public function getRoutePrefix() {
        return 'backend_equipo_n';
    }

    /**
     * Define los atributos de la clase que no se pueden repetir
     * @return mixed array ['nombre', 'ci']
     */
    public function keysUnique() {
        return ['nombre'];
    }
}
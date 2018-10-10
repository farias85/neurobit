<?php

namespace NB\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use NB\CommonBundle\Extension\EntityNameExtension;
use NB\CommonBundle\Traits\ImageTrait;
use NB\CommonBundle\Traits\UserTrait;
use NB\CommonBundle\Util\Entity;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity
 */
class Usuario implements EntityNameExtension, AdvancedUserInterface, \Serializable {

    use UserTrait;
    use ImageTrait;

    const ROLE_DEFAULT = 'ROLE_TRABAJADOR';
    const ROLE_SECRETARIO = 'ROLE_SECRETARIO';

    public function __construct() {
        $this->isActive = false;
        $this->isConfirm = false;
        $this->roles = [static::ROLE_DEFAULT];
        $this->ref = md5(uniqid(null, true));
        $this->verificationKey = md5(uniqid(null, true));
    }

    public function getEntityName() {
        return Entity::USUARIO;
    }

    public function __toString() {
        return $this->getName() . ' ' . $this->getLastname();
    }
}

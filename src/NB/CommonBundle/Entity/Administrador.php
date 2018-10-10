<?php

namespace NB\CommonBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use NB\CommonBundle\Extension\EntityNameExtension;
use NB\CommonBundle\Traits\ImageTrait;
use NB\CommonBundle\Traits\UserTrait;
use NB\CommonBundle\Util\Entity;
use Symfony\Component\Security\Core\User\AdvancedUserInterface;

/**
 * Administrador
 *
 * @ORM\Table(name="administrador")
 * @ORM\Entity
 */
class Administrador implements EntityNameExtension, AdvancedUserInterface, \Serializable {

    const ROLE_DEFAULT = 'ROLE_ADMIN';
    const ROLE_SUPER_ADMIN = 'ROLE_SUPER_ADMIN';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", nullable=false)
     */
    protected $email;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=50, nullable=true)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=100, nullable=true)
     */
    protected $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=20, nullable=true)
     */
    protected $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="verification_key", type="string", length=100, nullable=true)
     */
    protected $verificationKey;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="text", nullable=false)
     */
    protected $password;

    /**
     * @var string
     *
     * @ORM\Column(name="plain_password", type="text", nullable=false)
     */
    protected $plainPassword;

    /**
     * @var string
     *
     * @ORM\Column(name="salt", type="text", nullable=true)
     */
    protected $salt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="latest_connection", type="datetime", nullable=true)
     */
    protected $latestConnection;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_active", type="boolean", nullable=false)
     */
    protected $isActive;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_super_admin", type="boolean", nullable=false)
     */
    protected $isSuperAdmin;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_confirm", type="boolean", nullable=false)
     */
    protected $isConfirm;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=100, nullable=true)
     */
    protected $slug;
    /**
     * @var boolean
     *
     * @ORM\Column(name="bnf", type="boolean", nullable=false)
     */
    protected $bnf;

    /**
     * @var string
     *
     * @ORM\Column(name="ref", type="string", length=100, nullable=true)
     */
    private $ref;

    /**
     * @var array
     */
    protected $roles;

    public function __construct() {
        $this->isActive = false;
        $this->isConfirm = false;
        $this->isSuperAdmin = false;
        $this->roles = [];
        $this->ref = md5(uniqid(null, true));
        $this->verificationKey = md5(uniqid(null, true));
        $this->bnf = false;
    }

    public function addRole($role) {
        $role = strtoupper($role);
        if ($role === static::ROLE_DEFAULT) {
            return $this;
        }

        if (!in_array($role, $this->roles, true)) {
            $this->roles[] = $role;
        }

        return $this;
    }

    /**
     * Returns the user roles
     *
     * @return array The roles
     */
    public function getRoles() {
        $roles = $this->roles;

        $roles[] = static::ROLE_DEFAULT;
//        VarDumper::dump($roles); die();

        return array_unique($roles);
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param integer $email
     *
     * @return Administrador
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return integer
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Administrador
     */
    public function setName($nombre) {
        $this->name = $nombre;
        $this->slug = Util::getSlug($nombre . ' ' . $this->lastname);
        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set apellidos
     *
     * @param string $apellidos
     *
     * @return Administrador
     */
    public function setLastname($apellidos) {
        $this->lastname = $apellidos;
        return $this;
    }

    /**
     * Get apellidos
     *
     * @return string
     */
    public function getLastname() {
        return $this->lastname;
    }

    /**
     * Set telefono
     *
     * @param string $phone
     *
     * @return Administrador
     */
    public function setPhone($phone) {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get telefono
     *
     * @return string
     */
    public function getPhone() {
        return $this->phone;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Administrador
     */
    public function setPassword($password) {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Set salt
     *
     * @param string $salt
     *
     * @return Administrador
     */
    public function setSalt($salt) {
        $this->salt = $salt;

        return $this;
    }

    /**
     * Get salt
     *
     * @return string
     */
    public function getSalt() {
        return $this->salt;
    }

    public function getUsername() {
        return $this->getEmail();
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return Administrador
     */
    public function setIsActive($isActive) {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive() {
        return $this->isActive;
    }

    public function getPlainPassword() {
        return $this->plainPassword;
    }

    /**
     * Set password
     *
     * @param boolean $password
     *
     * @return Administrador
     */
    public function setPlainPassword($password) {
        $this->plainPassword = $password;

        return $this;
    }

    /**
     * @return string
     */
    public function getVerificationKey() {
        return $this->verificationKey;
    }

    /**
     * @param string $verificationKey
     *
     * @return Administrador
     */
    public function setVerificationKey($verificationKey) {
        $this->verificationKey = $verificationKey;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getLatestConnection() {
        return $this->latestConnection;
    }

    /**
     * @param \DateTime $latestConnection
     *
     * @return Administrador
     */
    public function setLatestConnection($latestConnection) {
        $this->latestConnection = $latestConnection;
        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug() {
        return $this->slug;
    }

    public function eraseCredentials() {
    }

    public function isAccountNonExpired() {
        return true;
    }

    public function isAccountNonLocked() {
        return true;
    }

    public function isCredentialsNonExpired() {
        return true;
    }

    public function isEnabled() {
        return $this->isActive;
    }

    /** @see \Serializable::serialize() */
    public function serialize() {
        return serialize(array(
            $this->id,
            $this->email,
            $this->password,
            $this->isActive,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized) {
        list (
            $this->id,
            $this->email,
            $this->password,
            $this->isActive,
            // see section on salt below
            // $this->salt
            ) = unserialize($serialized);
    }

    public function __toString() {
        return $this->getName() . ' ' . $this->getLastname();
    }

    /**
     * Set isConfirm
     *
     * @param boolean $isConfirm
     *
     * @return Administrador
     */
    public function setIsConfirm($isConfirm) {
        $this->isConfirm = $isConfirm;

        return $this;
    }

    /**
     * Get isConfirm
     *
     * @return boolean
     */
    public function getIsConfirm() {
        return $this->isConfirm;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Administrador
     */
    public function setSlug($slug) {
        $this->slug = $slug;

        return $this;
    }

    public function getEntityName() {
        return Entity::ADMINISTRADOR;
    }

    /**
     * @return bool
     */
    public function isSuperAdmin(): bool {
        return $this->isSuperAdmin;
    }

    /**
     * @return bool
     */
    public function getIsSuperAdmin(): bool {
        return $this->isSuperAdmin;
    }

    /**
     * @param bool $isSuperAdmin
     */
    public function setIsSuperAdmin(bool $isSuperAdmin) {
        $this->isSuperAdmin = $isSuperAdmin;
    }

    /**
     * @return string
     */
    public function getRef() {
        return $this->ref;
    }

    /**
     * @param string $ref
     */
    public function setRef(string $ref) {
        $this->ref = $ref;
    }

    /**
     * @return bool
     */
    public function isBnf(): bool {
        return $this->bnf;
    }

    /**
     * @return bool
     */
    public function getBnf(): bool {
        return $this->bnf;
    }

    /**
     * @param bool $bnf
     */
    public function setBnf(bool $bnf) {
        $this->bnf = $bnf;
    }
}

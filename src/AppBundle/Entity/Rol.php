<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
//use Symfony\Component\Security\Core\Role\RoleInterface;

use Doctrine\Common\Collections\ArrayCollection;

/**
 * Rol
 *
 * @ORM\Table(name="rol")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RolRepository")
 */
class Rol //Implements RoleInterface
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="role", type="string", length=255)
     */
    private $role;

    /**
     * @var string
     *
     * @ORM\Column(name="descripcion", type="string", length=255, nullable=true)
     */
    private $descripcion;

    /**
     * @var bool
     *
     * @ORM\Column(name="estatus", type="boolean")
     */
    private $estatus;

    public function __toString()
    {
        return $this->descripcion;
    }

    /**
     * @ORM\OneToMany(targetEntity="Usuario", mappedBy="rol")
     */
    private $usuarios;

    public function __construct()
    {
        $this->usuarios = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set role
     *
     * @param string $role
     *
     * @return Rol
     */
    public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Get role
     *
     * @return string
     *
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Rol
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set estatus
     *
     * @param boolean $estatus
     *
     * @return Rol
     */
    public function setEstatus($estatus)
    {
        $this->estatus = $estatus;

        return $this;
    }

    /**
     * Get estatus
     *
     * @return bool
     */
    public function getEstatus()
    {
        return $this->estatus;
    }



    /**
     * Add user
     *
     * @param \AppBundle\Entity\Usuario $usuario
     *
     * @return Rol
     */
    public function addUser(\AppBundle\Entity\Usuario $usuario)
    {
        $this->usuarios[] = $usuario;
        return $this;
    }
    /**
     * Remove user
     *
     * @param \AppBundle\Entity\Usuario $usuario
     */
    public function removeUser(\AppBundle\Entity\Usuario $usuario)
    {
        $this->usuarios->removeElement($usuario);
    }

    /**
     * Get usuarios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsuarios()
    {
        return $this->usuarios;
    }

    /**
     * Add usuario
     *
     * @param \AppBundle\Entity\Usuario $usuario
     *
     * @return Rol
     */
    public function addUsuario(\AppBundle\Entity\Usuario $usuario)
    {
        $this->usuarios[] = $usuario;

        return $this;
    }

    /**
     * Remove usuario
     *
     * @param \AppBundle\Entity\Usuario $usuario
     */
    public function removeUsuario(\AppBundle\Entity\Usuario $usuario)
    {
        $this->usuarios->removeElement($usuario);
    }
}

<?php

namespace AppBundle\Entity\JRFMarine;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Marca
 *
 * @ORM\Table(name="j_r_f_marine_marca")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\JRFMarine\MarcaRepository")
 * @Vich\Uploadable
 */
class Marca
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
     * @ORM\Column(name="nombre", type="string", length=50)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="imagen", type="string", nullable=true)
     */
    private $imagen;

    /**
     * @var File
     *
     * @Assert\Image()
     *
     * @Vich\UploadableField(
     *     mapping="jrf_producto_marca",
     *     fileNameProperty="imagen"
     * )
     */
    private $imagenFile;

    /**
     * @var \DateTimeInterface
     *
     * @ORM\Column(name="update_at", type="datetime")
     */
    private $updateAt;

    public function __construct()
    {
        $this->updateAt = new \DateTime();
    }

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
     * Set nombre.
     *
     * @param string $nombre
º     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    /**
     * Get nombre.
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set imagen.
     *
     * @param string|null $imagen
º     */
    public function setImagen($imagen = null)
    {
        $this->imagen = $imagen;
    }

    /**
     * Get imagen.
     *
     * @return string|null
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    /**
     * @return File
     */
    public function getImagenFile()
    {
        return $this->imagenFile;
    }

    /**
     * @param File $imagenFile
     */
    public function setImagenFile(File $imagenFile = null)
    {
        $this->imagenFile = $imagenFile;

        if (null !== $imagenFile) {
            $this->updateAt = new \DateTime();
        }
    }

    /**
     * Set updateAt.
     *
     * @param \DateTime $updateAt
º     */
    public function setUpdateAt($updateAt)
    {
        $this->updateAt = $updateAt;
    }

    /**
     * Get updateAt.
     *
     * @return \DateTime
     */
    public function getUpdateAt()
    {
        return $this->updateAt;
    }
}
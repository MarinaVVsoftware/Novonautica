<?php

namespace AppBundle\Entity\Tienda;

use AppBundle\Entity\Cliente;
use AppBundle\Entity\Contabilidad\Facturacion;
use AppBundle\Entity\Tienda\Venta\Concepto;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Venta
 *
 * @ORM\Table(name="tienda_venta")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Tienda\VentaRepository")
 * @ORM\EntityListeners({"VentaListener"})
 */
class Venta
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
     * @var int
     *
     * @Assert\NotNull(message="Este campo no puede estar vacio")
     *
     * @ORM\Column(name="iva", type="integer")
     */
    private $iva;

    /**
     * @var int
     *
     * @Assert\NotNull(message="Este campo no puede estar vacio")
     *
     * @ORM\Column(name="descuento", type="bigint")
     */
    private $descuento;

    /**
     * @var int
     *
     * @Assert\NotNull(message="Este campo no puede estar vacio")
     *
     * @ORM\Column(name="subtotal", type="bigint")
     */
    private $subtotal;

    /**
     * @var int
     *
     * @Assert\NotNull(message="Este campo no puede estar vacio")
     *
     * @ORM\Column(name="total", type="bigint")
     */
    private $total;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var Cliente
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Cliente")
     */
    private $cliente;

    /**
     * @var Concepto
     *
     * @Assert\Valid()
     * @Assert\Count(
     *     min="1",
     *     minMessage="Debes incluir al menos un producto para realizar una venta",
     * )
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Tienda\Venta\Concepto", mappedBy="venta", cascade={"persist"})
     */
    private $conceptos;

    /**
     * @var Facturacion
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Contabilidad\Facturacion", inversedBy="cotizacionTienda")
     */
    private $factura;

    public function __construct()
    {
        $this->conceptos = new ArrayCollection();
        $this->createdAt = new \DateTime();
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $iva
     */
    public function setIva($iva)
    {
        $this->iva = $iva;
    }

    /**
     * @return int
     */
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * @param int $descuento
     */
    public function setDescuento($descuento)
    {
        $this->descuento = $descuento;
    }

    /**
     * @return int
     */
    public function getDescuento()
    {
        return $this->descuento;
    }

    /**
     * @param int $subtotal
     */
    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;
    }

    /**
     * @return int
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * @param int $total
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set cliente.
     *
     * @param Cliente|null $cliente
     *
     * @return Venta
     */
    public function setCliente(Cliente $cliente = null)
    {
        $this->cliente = $cliente;

        return $this;
    }

    /**
     * Get cliente.
     *
     * @return Cliente|null
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Add concepto.
     *
     * @param Concepto $concepto
     */
    public function addConcepto(Concepto $concepto)
    {
        $concepto->setVenta($this);
        $this->conceptos[] = $concepto;
    }

    /**
     * Remove concepto.
     *
     * @param Concepto $concepto
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeConcepto(Concepto $concepto)
    {
        return $this->conceptos->removeElement($concepto);
    }

    /**
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConceptos()
    {
        return $this->conceptos;
    }

    /**
     * @return Facturacion
     */
    public function getFactura()
    {
        return $this->factura;
    }

    /**
     * @param Facturacion $factura
     */
    public function setFactura(Facturacion $factura = null)
    {
        $this->factura = $factura;
    }

    /** HELPER METHOS */

    public function getEstatuspago()
    {
        return 2;
    }
}

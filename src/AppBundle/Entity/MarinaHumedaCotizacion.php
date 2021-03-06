<?php

namespace AppBundle\Entity;

use AppBundle\Entity\Contabilidad\Facturacion;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * MarinaHumedaCotizacion
 *
 * @ORM\Table(name="marina_humeda_cotizacion")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MarinaHumedaCotizacionRepository")
 */
class MarinaHumedaCotizacion
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @Groups({"facturacion", "currentOcupation"})
     */
    private $id;

    /**
     * @var \DateTime
     * @Assert\Date()
     *
     * @ORM\Column(name="fecha_llegada", type="datetime", nullable=true)
     */
    private $fechaLlegada;

    /**
     * @var \DateTime
     * @Assert\Date()
     *
     * @ORM\Column(name="fecha_salida", type="datetime", nullable=true)
     */
    private $fechaSalida;

    /**
     * @var int
     *
     * @ORM\Column(name="diasEstadia", type="integer", nullable=true)
     */
    private $diasEstadia;

    /**
     * @var int
     *
     * @ORM\Column(name="diasElectricidad", type="integer", nullable=true )
     */
    private $diasElectricidad;

    /**
     * @var float
     *
     * @ORM\Column(name="descuentoEstadia", type="float", nullable=true)
     */
    private $descuentoEstadia;

    /**
     * @var float
     *
     * @ORM\Column(name="descuento_electricidad", type="float", nullable=true)
     */
    private $descuentoElectricidad;

    /**
     * @var float
     *
     * @Groups({"facturacion"})
     *
     * @ORM\Column(name="dolar", type="float", nullable=true)
     */
    private $dolar;

    /**
     * @var float
     *
     * @ORM\Column(name="iva", type="float", nullable=true)
     */
    private $iva;

    /**
     * @var integer
     *
     * @Groups({"facturacion"})
     *
     * @ORM\Column(name="subtotal", type="bigint", nullable=true)
     */
    private $subtotal;

    /**
     * @var integer
     *
     * @Groups({"facturacion"})
     *
     * @ORM\Column(name="ivatotal", type="bigint", nullable=true)
     */
    private $ivatotal;

    /**
     * @var integer
     *
     * @Groups({"facturacion"})
     *
     * @ORM\Column(name="descuentototal", type="bigint", nullable=true)
     */
    private $descuentototal;

    /**
     * @var integer
     *
     * @Groups({"facturacion"})
     *
     * @ORM\Column(name="total", type="bigint", nullable=true)
     */
    private $total;

    /**
     * @var integer
     *
     * @ORM\Column(name="pagado", type="bigint", nullable=true)
     */
    private $pagado;

    /**
     * @var int 0 = No ha pagado, 1 = Tiene adeudos, 2 = Ya pago
     *
     * @ORM\Column(name="estatuspago", type="smallint", nullable=true)
     */
    private $estatuspago;

    /**
     * @var string
     *
     * @ORM\Column(name="mensaje", type="text", nullable=true)
     */
    private $mensaje;


    /**
     * @var int Estatus: 0 Pendiente, 1 Rechazado, 2 Aceptado
     *
     * @ORM\Column(name="validanovo", type="smallint")
     */
    private $validanovo;

    /**
     * @var \DateTimeImmutable
     *
     * @ORM\Column(name="registro_valida_novo", type="datetime_immutable", nullable=true)
     */
    private $registroValidaNovo;

    /**
     * @var int Estatus: 0 Pendiente, 1 Rechazado, 2 Aceptado
     *
     * @ORM\Column(name="validacliente", type="smallint")
     */
    private $validacliente;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="limite_valida_cliente", type="datetime", nullable=true)
     */
    private $limiteValidaCliente;

    /**
     * @var string
     *
     * @ORM\Column(name="quien_acepto", type="string", length=100, nullable=true)
     */
    private $quienAcepto;

    /**
     * @var \DateTimeImmutable
     *
     * @ORM\Column(name="registro_valida_cliente", type="datetime_immutable", nullable=true)
     */
    private $registroValidaCliente;

    /**
     * @var string
     *
     * @ORM\Column(name="notasnovo", type="text", nullable=true)
     */
    private $notasnovo;

    /**
     * @var string
     *
     * @ORM\Column(name="notascliente", type="text", nullable=true)
     */
    private $notascliente;

    /**
     * @var string
     *
     * @ORM\Column(name="nombrevalidanovo", type="string", length=255, nullable=true)
     */
    private $nombrevalidanovo;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecharegistro", type="datetime")
     */
    private $fecharegistro;

    /**
     * @var bool
     *
     * @ORM\Column(name="estatus", type="boolean")
     */
    private $estatus;

    /**
     * @var boolean
     *
     * @ORM\Column(name="is_deleted", type="boolean")
     */
    private $isDeleted;

    /**
     * @var int
     *
     * @Groups({"facturacion", "currentOcupation"})
     *
     * @ORM\Column(name="folio", type="integer", length=255)
     */
    private $folio;

    /**
     * @var int
     *
     * @Groups({"facturacion", "currentOcupation"})
     *
     * @ORM\Column(name="foliorecotiza", type="integer", length=255)
     */
    private $foliorecotiza;

    /**
     * @var string
     *
     * @ORM\Column(name="token", type="string", length=110, nullable=true)
     */
    private $token;

    /**
     * @var string
     *
     * @ORM\Column(name="metodopago", type="string", length=100, nullable=true)
     */
    private $metodopago;

    /**
     * @var string
     *
     * @ORM\Column(name="codigoseguimiento", type="string", length=255, nullable=true)
     */
    private $codigoseguimiento;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecharealpago", type="datetime", nullable=true)
     */
    private $fecharespuesta;

    /**
     * @var bool
     *
     * @ORM\Column(name="notificar_cliente", type="boolean")
     */
    private $notificarCliente;

    /**
     * @var \DateTimeImmutable
     *
     * @ORM\Column(name="registro_pago_completado", type="datetime_immutable", nullable=true)
     */
    private $registroPagoCompletado;

    /**
     * @Groups({"currentOcupation"})
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Cliente", inversedBy="mhcotizaciones")
     * @ORM\JoinColumn(name="idcliente", referencedColumnName="id",onDelete="CASCADE")
     */
    private $cliente;

    /**
     * @Groups({"currentOcupation"})
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Barco", inversedBy="mhcotizaciones")
     * @ORM\JoinColumn(name="idbarco", referencedColumnName="id",onDelete="CASCADE")
     */
    private $barco;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Slip", inversedBy="mhcotizaciones")
     * @ORM\JoinColumn(name="idslip", referencedColumnName="id", onDelete="CASCADE")
     */
    private $slip;

    /**
     * @Groups({"facturacion"})
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\MarinaHumedaCotizaServicios", mappedBy="marinahumedacotizacion",cascade={"persist"})
     */
    private $mhcservicios;

    /**
     * @Groups({"facturacion"})
     *
     * @Assert\Valid()
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Pago", mappedBy="mhcotizacion",cascade={"persist","remove"})
     */
    private $pagos;

    /**
     * @ORM\OneToOne(targetEntity="SlipMovimiento", mappedBy="marinahumedacotizacion", cascade={"persist"})
     */
    private $slipmovimiento;

    /**
     * @Assert\Valid()
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\CotizacionNota", mappedBy="mhcotizacion",cascade={"persist","remove"})
     */
    private $cotizacionnotas;

    /**
     * Quien creo esta cotizacion
     *
     * @var Usuario
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Usuario")
     */
    private $creador;

    /**
     * @var float
     *
     * @ORM\Column(name="porcentajeMoratorio", type="float", nullable=true)
     */
    private $porcentajeMoratorio;

    /**
     * @var integer
     *
     * @ORM\Column(name="moratoriaTotal", type="bigint", nullable=true)
     */
    private $moratoriaTotal;

    /**
     * @var Facturacion
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Contabilidad\Facturacion", inversedBy="cotizacionMarina")
     */
    private $factura;


    public function __construct()
    {
        $this->mhcservicios = new ArrayCollection();
        $this->pagos = new ArrayCollection();
        $this->notificarCliente = true;
        $this->cotizacionnotas = new ArrayCollection();
        $this->registroValidaNovo = null;
        $this->registroValidaCliente = null;
        $this->registroPagoCompletado = null;
        $this->fecharegistro = new \DateTime();
        $this->isDeleted = false;
    }

    public function __toString()
    {
        $f = $this->folio . ($this->foliorecotiza ? '-'.$this->foliorecotiza : '');
        return 'Folio: ' . $f . ' - Barco: ' . $this->getBarco() . ' - Eslora: ' . $this->getBarco()->getEslora();
    }

    public function __clone()
    {
        $this->id = null;
    }

    public function getFolioString()
    {
        return !$this->foliorecotiza ? $this->folio : $this->folio . '-' . $this->foliorecotiza;
    }

    public function getKind()
    {
        return 'Marina';
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
     * Set fechaLlegada
     *
     * @param \DateTime $fechaLlegada
     *
     * @return MarinaHumedaCotizacion
     */
    public function setFechaLlegada($fechaLlegada)
    {
        $this->fechaLlegada = $fechaLlegada;

        return $this;
    }

    /**
     * Get fechaLlegada
     *
     * @return \DateTime
     */
    public function getFechaLlegada()
    {
        return $this->fechaLlegada;
    }

    /**
     * Set fechaSalida
     *
     * @param \DateTime $fechaSalida
     *
     * @return MarinaHumedaCotizacion
     */
    public function setFechaSalida($fechaSalida)
    {
        $this->fechaSalida = $fechaSalida;

        return $this;
    }

    /**
     * Get fechaSalida
     *
     * @return \DateTime
     */
    public function getFechaSalida()
    {
        return $this->fechaSalida;
    }

    /**
     * Set descuentoEstadia
     *
     * @param float $descuentoEstadia
     *
     * @return MarinaHumedaCotizacion
     */
    public function setDescuentoEstadia($descuentoEstadia)
    {
        $this->descuentoEstadia = $descuentoEstadia;

        return $this;
    }

    /**
     * Get descuentoEstadia
     *
     * @return float
     */
    public function getDescuentoEstadia()
    {
        return $this->descuentoEstadia;
    }

    /**
     * Set dolar
     *
     * @param float $dolar
     *
     * @return MarinaHumedaCotizacion
     */
    public function setDolar($dolar)
    {
        $this->dolar = $dolar;

        return $this;
    }

    /**
     * Get dolar
     *
     * @return float
     */
    public function getDolar()
    {
        return $this->dolar;
    }

    /**
     * Set iva
     *
     * @param float $iva
     *
     * @return MarinaHumedaCotizacion
     */
    public function setIva($iva)
    {
        $this->iva = $iva;

        return $this;
    }

    /**
     * Get iva
     *
     * @return float
     */
    public function getIva()
    {
        return $this->iva;
    }

    /**
     * Set subtotal
     *
     * @param int $subtotal
     *
     * @return MarinaHumedaCotizacion
     */
    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;

        return $this;
    }

    /**
     * Get subtotal
     *
     * @return int
     */
    public function getSubtotal()
    {
        return $this->subtotal;
    }

    /**
     * Set ivatotal
     *
     * @param int $ivatotal
     *
     * @return MarinaHumedaCotizacion
     */
    public function setIvatotal($ivatotal)
    {
        $this->ivatotal = $ivatotal;

        return $this;
    }

    /**
     * Get ivatotal
     *
     * @return int
     */
    public function getIvatotal()
    {
        return $this->ivatotal;
    }

    /**
     * Set descuentototal
     *
     * @param int $descuentototal
     *
     * @return MarinaHumedaCotizacion
     */
    public function setDescuentototal($descuentototal)
    {
        $this->descuentototal = $descuentototal;

        return $this;
    }

    /**
     * Get descuentototal
     *
     * @return int
     */
    public function getDescuentototal()
    {
        return $this->descuentototal;
    }

    /**
     * Set total
     *
     * @param int $total
     *
     * @return MarinaHumedaCotizacion
     */
    public function setTotal($total)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return int
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Set validanovo
     *
     * @param integer $validanovo
     *
     * @return MarinaHumedaCotizacion
     */
    public function setValidanovo($validanovo)
    {
        $this->validanovo = $validanovo;

        return $this;
    }

    /**
     * Get validanovo
     *
     * @return int
     */
    public function getValidanovo()
    {
        return $this->validanovo;
    }

    /**
     * Set registroValidaNovo.
     *
     * @param \DateTimeImmutable|null $registroValidaNovo
     *
     * @return MarinaHumedaCotizacion
     */
    public function setRegistroValidaNovo($registroValidaNovo = null)
    {
        $this->registroValidaNovo = $registroValidaNovo;

        return $this;
    }

    /**
     * Get registroValidaNovo.
     *
     * @return \DateTimeImmutable|null
     */
    public function getRegistroValidaNovo()
    {
        return $this->registroValidaNovo;
    }

    /**
     * Set validacliente
     *
     * @param integer $validacliente
     *
     * @return MarinaHumedaCotizacion
     */
    public function setValidacliente($validacliente)
    {
        $this->validacliente = $validacliente;

        return $this;
    }

    /**
     * Get validacliente
     *
     * @return int
     */
    public function getValidacliente()
    {
        return $this->validacliente;
    }

    /**
     * Set registroValidaCliente.
     *
     * @param \DateTimeImmutable|null $registroValidaCliente
     *
     * @return MarinaHumedaCotizacion
     */
    public function setRegistroValidaCliente($registroValidaCliente = null)
    {
        $this->registroValidaCliente = $registroValidaCliente;

        return $this;
    }

    /**
     * Get registroValidaCliente.
     *
     * @return \DateTimeImmutable|null
     */
    public function getRegistroValidaCliente()
    {
        return $this->registroValidaCliente;
    }

    /**
     * Set notasnovo
     *
     * @param string $notasnovo
     *
     * @return MarinaHumedaCotizacion
     */
    public function setNotasnovo($notasnovo)
    {
        $this->notasnovo = $notasnovo;

        return $this;
    }

    /**
     * Get notasnovo
     *
     * @return string
     */
    public function getNotasnovo()
    {
        return $this->notasnovo;
    }

    /**
     * @param string $nombrevalidanovo
     */
    public function setNombrevalidanovo($nombrevalidanovo)
    {
        $this->nombrevalidanovo = $nombrevalidanovo;
    }

    /**
     * @return string
     */
    public function getNombrevalidanovo()
    {
        return $this->nombrevalidanovo;
    }

    /**
     * Set estatus
     *
     * @param boolean $estatus
     *
     * @return MarinaHumedaCotizacion
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
     * set folio
     *
     * @param integer $folio
     *
     * @return MarinaHumedaCotizacion
     */
    public function setFolio($folio)
    {
        $this->folio = $folio;

        return $this;
    }

    /**
     * Get folio
     *
     * @return int
     */
    public function getFolio()
    {
        return $this->folio;
    }

    /**
     * set foliorecotiza
     *
     * @param integer $foliorecotiza
     *
     * @return MarinaHumedaCotizacion
     */
    public function setFoliorecotiza($foliorecotiza)
    {
        $this->foliorecotiza = $foliorecotiza;

        return $this;
    }

    /**
     * Get foliorecotiza
     *
     * @return int
     */
    public function getFoliorecotiza()
    {
        return $this->foliorecotiza;
    }

    /**
     * Set notascliente
     *
     * @param string $notascliente
     *
     * @return MarinaHumedaCotizacion
     */
    public function setNotascliente($notascliente)
    {
        $this->notascliente = $notascliente;

        return $this;
    }

    /**
     * Get notascliente
     *
     * @return string
     */
    public function getNotascliente()
    {
        return $this->notascliente;
    }

    /**
     * Set fecharegistro
     *
     * @param \DateTime $fecharegistro
     *
     * @return MarinaHumedaCotizacion
     */
    public function setFecharegistro($fecharegistro)
    {
        $this->fecharegistro = $fecharegistro;

        return $this;
    }

    /**
     * Get fecharegistro
     *
     * @return \DateTime
     */
    public function getFecharegistro()
    {
        return $this->fecharegistro;
    }

    /**
     * Set cliente
     *
     * @param Cliente $cliente
     *
     * @return MarinaHumedaCotizacion
     */
    public function setCliente(Cliente $cliente = null)
    {
        $this->cliente = $cliente;
        return $this;
    }

    /**
     * Get cliente
     *
     * @return Cliente
     */
    public function getCliente()
    {
        return $this->cliente;
    }

    /**
     * Set barco
     *
     * @param Barco $barco
     *
     * @return MarinaHumedaCotizacion
     */
    public function setBarco(Barco $barco = null)
    {
        $this->barco = $barco;
        return $this;
    }

    /**
     * Get barco
     *
     * @return Barco
     */
    public function getBarco()
    {
        return $this->barco;
    }

    /**
     * Add marinahumedacotizaservicios
     *
     * @param MarinaHumedaCotizaServicios $marinahumedacotizaservicios
     *
     * @return MarinaHumedaCotizacion
     */
    public function addMarinaHumedaCotizaServicios(MarinaHumedaCotizaServicios $marinahumedacotizaservicios)
    {
        $marinahumedacotizaservicios->setMarinaHumedaCotizacion($this);
        $this->mhcservicios[] = $marinahumedacotizaservicios;
        return $this;
    }

    /**
     * Remove marinahumedacotizaservicios
     *
     * @param MarinaHumedaCotizaServicios $marinahumedacotizaservicios
     */
    public function removeMarinaHumedaCotizaServicios(MarinaHumedaCotizaServicios $marinahumedacotizaservicios)
    {
        $this->mhcservicios->removeElement($marinahumedacotizaservicios);
    }

    /**
     * Get mhcservicios
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMHCservicios()
    {
        return $this->mhcservicios;
    }

    /**
     * Add mhcservicio
     *
     * @param MarinaHumedaCotizaServicios $mhcservicio
     *
     * @return MarinaHumedaCotizacion
     */
    public function addMhcservicio(MarinaHumedaCotizaServicios $mhcservicio)
    {
        $this->mhcservicios[] = $mhcservicio;

        return $this;
    }

    /**
     * Remove mhcservicio
     *
     * @param MarinaHumedaCotizaServicios $mhcservicio
     */
    public function removeMhcservicio(MarinaHumedaCotizaServicios $mhcservicio)
    {
        $this->mhcservicios->removeElement($mhcservicio);
    }

    /**
     * @return string
     */
    public function getMensaje()
    {
        return $this->mensaje;
    }

    /**
     * @param string $mensaje
     */
    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;
    }


    /**
     * Set slip
     *
     * @param Slip $slip
     *
     * @return MarinaHumedaCotizacion
     */
    public function setSlip(Slip $slip = null)
    {
        $this->slip = $slip;

        return $this;
    }

    /**
     * Get slip
     *
     * @return Slip
     */
    public function getSlip()
    {
        return $this->slip;
    }

    /**
     * Add pago
     *
     * @param Pago $pago
     *
     * @return MarinaHumedaCotizacion
     */
    public function addPago(Pago $pago)
    {
        $pago->setMhcotizacion($this);
        $this->pagos[] = $pago;

        return $this;
    }

    /**
     * Remove pago
     *
     * @param Pago $pago
     */
    public function removePago(Pago $pago)
    {
        $this->pagos->removeElement($pago);
    }

    /**
     * Get pagos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPagos()
    {
        return $this->pagos;
    }

    /**
     * @return int
     */
    public function getEstatuspago()
    {
        return $this->estatuspago;
    }

    /**
     * @param int $estatuspago
     */
    public function setEstatuspago($estatuspago)
    {
        $this->estatuspago = $estatuspago;
    }

    /**
     * @return float
     */
    public function getPagado()
    {
        return $this->pagado;
    }

    /**
     * @param float $pagado
     */
    public function setPagado($pagado)
    {
        $this->pagado = $pagado;
    }

    /**
     * @return string
     */
    public function getMetodopago()
    {
        return $this->metodopago;
    }

    /**
     * @param string $metodopago
     */
    public function setMetodopago($metodopago)
    {
        $this->metodopago = $metodopago;
    }

    /**
     * @return string
     */
    public function getCodigoseguimiento()
    {
        return $this->codigoseguimiento;
    }

    /**
     * @param string $codigoseguimiento
     */
    public function setCodigoseguimiento($codigoseguimiento)
    {
        $this->codigoseguimiento = $codigoseguimiento;
    }

    /**
     * @return \DateTime
     */
    public function getFecharespuesta()
    {
        return $this->fecharespuesta;
    }

    /**
     * @param \DateTime $fecharespuesta
     */
    public function setFecharespuesta($fecharespuesta)
    {
        $this->fecharespuesta = $fecharespuesta;
    }

    /**
     * Set slipmovimiento
     *
     * @param SlipMovimiento $slipmovimiento
     *
     * @return MarinaHumedaCotizacion
     */
    public function setSlipmovimiento(SlipMovimiento $slipmovimiento = null)
    {
        $this->slipmovimiento = $slipmovimiento;

        return $this;
    }

    /**
     * Get slipmovimiento
     *
     * @return SlipMovimiento
     */
    public function getSlipmovimiento()
    {
        return $this->slipmovimiento;
    }

    /**
     * @return bool
     */
    public function isNotificarCliente()
    {
        return $this->notificarCliente;
    }

    /**
     * @param bool $notificarCliente
     */
    public function setNotificarCliente($notificarCliente)
    {
        $this->notificarCliente = $notificarCliente;
    }

    /**
     * Get notificarCliente.
     *
     * @return bool
     */
    public function getNotificarCliente()
    {
        return $this->notificarCliente;
    }

    /**
     * @return int
     */
    public function getDiasEstadia()
    {
        return $this->diasEstadia;
    }

    /**
     * @param int $diasEstadia
     */
    public function setDiasEstadia($diasEstadia)
    {
        $this->diasEstadia = $diasEstadia;
    }

    /**
     * @return int
     */
    public function getDiasElectricidad()
    {
        return $this->diasElectricidad;
    }

    /**
     * @param int $diasElectricidad
     */
    public function setDiasElectricidad($diasElectricidad)
    {
        $this->diasElectricidad = $diasElectricidad;
    }

    /**
     * Add cotizacionnota.
     *
     * @param CotizacionNota $cotizacionnota
     *
     * @return MarinaHumedaCotizacion
     */
    public function addCotizacionnota(CotizacionNota $cotizacionnota)
    {
        $cotizacionnota->setMhcotizacion($this);
        $this->cotizacionnotas[] = $cotizacionnota;

        return $this;
    }

    /**
     * Remove cotizacionnota.
     *
     * @param CotizacionNota $cotizacionnota
     *
     * @return boolean TRUE if this collection contained the specified element, FALSE otherwise.
     */
    public function removeCotizacionnota(CotizacionNota $cotizacionnota)
    {
        return $this->cotizacionnotas->removeElement($cotizacionnota);
    }

    /**
     * Get cotizacionnotas.
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCotizacionnotas()
    {
        return $this->cotizacionnotas;
    }


    /**
     * Set registroPagoCompletado.
     *
     * @param \DateTimeImmutable|null $registroPagoCompletado
     *
     * @return MarinaHumedaCotizacion
     */
    public function setRegistroPagoCompletado($registroPagoCompletado = null)
    {
        $this->registroPagoCompletado = $registroPagoCompletado;

        return $this;
    }

    /**
     * Get registroPagoCompletado.
     *
     * @return \DateTimeImmutable|null
     */
    public function getRegistroPagoCompletado()
    {
        return $this->registroPagoCompletado;
    }

    /**
     * @return Usuario
     */
    public function getCreador()
    {
        return $this->creador;
    }

    /**
     * @param Usuario $creador
     */
    public function setCreador($creador)
    {
        $this->creador = $creador;
    }

    /**
     * @return string
     */
    public function getQuienAcepto()
    {
        return $this->quienAcepto;
    }

    /**
     * @param string $quienAcepto
     */
    public function setQuienAcepto($quienAcepto)
    {
        $this->quienAcepto = $quienAcepto;
    }

    /**
     * @return string
     */
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * Set porcentajeMoratorio.
     *
     * @param float|null $porcentajeMoratorio
     *
     * @return MarinaHumedaCotizacion
     */
    public function setPorcentajeMoratorio($porcentajeMoratorio = null)
    {
        $this->porcentajeMoratorio = $porcentajeMoratorio;

        return $this;
    }

    /**
     * Get porcentajeMoratorio.
     *
     * @return float|null
     */
    public function getPorcentajeMoratorio()
    {
        return $this->porcentajeMoratorio;
    }

    /**
     * Set moratoriaTotal.
     *
     * @param int|null $moratoriaTotal
     *
     * @return MarinaHumedaCotizacion
     */
    public function setMoratoriaTotal($moratoriaTotal = null)
    {
        $this->moratoriaTotal = $moratoriaTotal;

        return $this;
    }

    /**
     * Get moratoriaTotal.
     *
     * @return int|null
     */
    public function getMoratoriaTotal()
    {
        return $this->moratoriaTotal;
    }

    /**
     * Set limiteValidaCliente.
     *
     * @param \DateTime|null $limiteValidaCliente
     *
     * @return MarinaHumedaCotizacion
     */
    public function setLimiteValidaCliente($limiteValidaCliente = null)
    {
        $this->limiteValidaCliente = $limiteValidaCliente;

        return $this;
    }

    /**
     * Get limiteValidaCliente.
     *
     * @return \DateTime|null
     */
    public function getLimiteValidaCliente()
    {
        return $this->limiteValidaCliente;
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

    /**
     * Set descuentoElectricidad.
     *
     * @param float|null $descuentoElectricidad
     *
     * @return MarinaHumedaCotizacion
     */
    public function setDescuentoElectricidad($descuentoElectricidad = null)
    {
        $this->descuentoElectricidad = $descuentoElectricidad;

        return $this;
    }

    /**
     * Get descuentoElectricidad.
     *
     * @return float|null
     */
    public function getDescuentoElectricidad()
    {
        return $this->descuentoElectricidad;
    }

    /**
     * Set isDeleted.
     *
     * @param bool $isDeleted
     *
     * @return MarinaHumedaCotizacion
     */
    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }

    /**
     * Get isDeleted.
     *
     * @return bool
     */
    public function isDeleted()
    {
        return $this->isDeleted;
    }
}

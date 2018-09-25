<?php

namespace AppBundle\Repository;

/**
 * AstilleroCotizacionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AstilleroCotizacionRepository extends \Doctrine\ORM\EntityRepository
{
    public function soloAceptados()
    {
        $qb = $this->createQueryBuilder('ac');

        return $qb
            ->select('ac')
            ->where($qb->expr()->eq('ac.validacliente',2))
            ->getQuery()
            ->getResult();
    }

    public function getCotizacionByFolio($folio)
    {
        $folios = explode('-', $folio);

        $qb = $this->createQueryBuilder('atc');

        $qb->where('atc.folio = :folio')
            ->setParameter('folio', $folios[0]);

        if (isset($folios[1])) {
            $qb->andWhere('atc.foliorecotiza = :foliorecotiza')
                ->setParameter('foliorecotiza', $folios[1]);
        }

        return $qb->getQuery()->getOneOrNullResult();
    }

    public function getAllClientes()
    {
        $qb = $this->createQueryBuilder('ac');

        return $qb
            ->select('cliente.nombre AS nombre')
            ->leftJoin('ac.cliente', 'cliente')
            ->distinct()
            ->getQuery()
            ->getResult();
    }

    public function getAllBarcos()
    {
        $qb = $this->createQueryBuilder('ac');

        return $qb
            ->select('barco.nombre AS nombre')
            ->leftJoin('ac.barco', 'barco')
            ->distinct()
            ->getQuery()
            ->getResult();
    }

    /**
     * @return string
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Doctrine\ORM\NoResultException
     */
    public function getMostDebtor()
    {
        return $this->createQueryBuilder('ac')
            ->leftJoin('ac.cliente', 'c')
            ->select('c.nombre')
            ->where('ac.validacliente = 2')
            ->groupBy('c.id')
            ->setMaxResults(1)
            ->getQuery()
            ->getSingleResult();
    }

    /**
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getTotalAdeudo()
    {
        return $this->createQueryBuilder('ac')
            ->select('SUM(ac.total)')
            ->where('ac.validacliente = 2')
            ->getQuery()
            ->getSingleScalarResult();
    }

    /**
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getTotalAbono()
    {
        return $this->createQueryBuilder('ac')
            ->select('SUM(ac.pagado)')
            ->where('ac.validacliente = 2')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function getWorkedBoatsByDaterange(\DateTime $start, \DateTime $end)
    {
        return $this->createQueryBuilder('ac')
            ->select('ac.fechaLlegada AS fecha' ,'COUNT(ac.id) AS total')
            ->where('ac.fechaLlegada BETWEEN :start AND :end')
            ->andWhere('ac.validacliente = 2')
            ->setParameters([
                'start' => $start,
                'end' => $end,
            ])
            ->groupBy('ac.fechaLlegada')
            ->orderBy('ac.fechaLlegada', 'ASC')
            ->getQuery()
            ->getScalarResult();
    }

    public function getClientesMorososLike($query)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT DISTINCT cliente.id, cliente.nombre AS text '.
                'FROM AppBundle:AstilleroCotizacion cotizacion '.
                'LEFT JOIN cotizacion.cliente cliente '.
                'WHERE (LOWER(cliente.nombre) LIKE ?1 AND cotizacion.validacliente = 2) '.
                'AND (cotizacion.estatuspago IS NULL OR cotizacion.estatuspago = 1) '.
                'ORDER BY cliente.nombre ASC '
            )
            ->setParameter(1, strtolower("%{$query}%"))
            ->setMaxResults(5)
            ->getArrayResult();
    }

    public function getEmbarcacionesdeMorososLike($query)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT DISTINCT barco.id, barco.nombre AS text '.
                'FROM AppBundle:AstilleroCotizacion cotizacion '.
                'LEFT JOIN cotizacion.barco barco '.
                'WHERE (LOWER(barco.nombre) LIKE ?1 AND cotizacion.validacliente = 2) '.
                'AND (cotizacion.estatuspago IS NULL OR cotizacion.estatuspago = 1) '.
                'ORDER BY barco.nombre ASC '
            )
            ->setParameter(1, strtolower("%{$query}%"))
            ->setMaxResults(5)
            ->getArrayResult();
    }

    function esMoneda($valor){
        return '$'.number_format($valor/100,2);
    }

    public function obtenIngresosTodos($idbarco,$inicio,$fin)
    {
        $resultado = [];
        $granVarada = 0;
        $granEstadia = 0;
        $granRampa = 0;
        $granKarcher = 0;
        $granExplanada = 0;
        $granElectricidad = 0;
        $granLimpieza = 0;
        $granInspeccionar = 0;
        $granDiasAdicionales = 0;
        $granSubTotServiciosBasicos = 0;
        $granSubTotServicios = 0;
        $granSubTotOtros = 0;
        $granSubTotProductos = 0;
        $granSubtotal = 0;
        $granIva = 0;
        $granTotal = 0;
        //--------------------
        $subTotProductos = 0;
        $subTotOtros = 0;
        $subTotServicios = 0;
        $subTotServiciosBasicos = 0;
        $varada = 0;
        $estadia = 0;
        $rampa = 0;
        $karcher = 0;
        $explanada = 0;
        $electricidad = 0;
        $limpieza = 0;
        $inspeccionar = 0;
        $diasAdicionales = 0;
        $subtotal = 0;
        $iva = 0;
        $total = 0;
        $nomServicios = '';
        //--------------------
        $condicion_barco = '';
        $condicion_inicio = '';
        $condicion_fin = '';
        if($idbarco !== '0'){$condicion_barco = ' AND Barco.id = :idBarco ';}
        if($inicio){$condicion_inicio = ' AND AstilleroCotizacion.fechaLlegada >= :fechaIni ';}
        if($fin){$condicion_fin = ' AND AstilleroCotizacion.fechaLlegada <= :fechaFin ';}
        $qry = 'SELECT 
                      AstilleroCotizacion.id as idCotizacion,
                      AstilleroCotizacion.fechaLlegada as fecha,
                      AstilleroCotizacion.folio as folio,
                      AstilleroCotizacion.foliorecotiza as foliorecotiza,
                      Barco.id as idbarco,
                      Barco.nombre as barco,
                      Servicio.nombre as servicio,
                      AstilleroServicioBasico.id as idServicioBasico,
                      AstilleroServicioBasico.nombre as servicioBasico,
                      Producto.nombre as producto,
                      acs.otroservicio as otro,
                      acs.cantidad as cantidad,
                      acs.subtotal as subtotal,
                      acs.iva as iva,
                      acs.total as total,
                      acs.divisa as divisa,
                      acs.estatus as estatus
                      FROM AppBundle:AstilleroCotizaServicio acs
                      LEFT JOIN acs.servicio Servicio 
                      LEFT JOIN acs.astilleroserviciobasico AstilleroServicioBasico 
                      LEFT JOIN acs.producto Producto
                      LEFT JOIN acs.astillerocotizacion AstilleroCotizacion
                      LEFT JOIN AstilleroCotizacion.barco Barco
                      WHERE AstilleroCotizacion.validacliente = 2  
                      AND acs.estatus = 1 ' .$condicion_barco.$condicion_inicio.$condicion_fin.
                    ' ORDER BY fecha,folio,foliorecotiza ASC';
        $servicios = $this->getEntityManager()->createQuery($qry);
        if($idbarco !== '0'){$servicios->setParameter('idBarco',$idbarco);}
        if($inicio){$servicios->setParameter('fechaIni',$inicio);}
        if($fin){$servicios->setParameter('fechaFin',$fin);}
        $servicios->getArrayResult();
        $c = 1;
        if($servicios){
            foreach ($servicios->getArrayResult() as $servicio){
                if($c === 1){
                    $auxIdCotizacion = $servicio['idCotizacion'];
                    $folio = $servicio['foliorecotiza']?$servicio['folio'].'-'.$servicio['foliorecotiza']:$servicio['folio'];
                    $fecha = $servicio['fecha'];
                    $barco = $servicio['barco'];
                }
                if($auxIdCotizacion !== $servicio['idCotizacion']){
                    array_push($resultado, [
                        'anio' => $fecha->format('Y'),
                        'mes' => $fecha->format('m'),
                        'dia' => $fecha->format('d/m/Y'),
                        'folio' => $folio,
                        'embarcacion' => $barco,
                        'varada' => $this->esMoneda($varada),
                        'estadia' => $this->esMoneda($estadia),
                        'rampa' => $this->esMoneda($rampa),
                        'karcher' => $this->esMoneda($karcher),
                        'explanada' => $this->esMoneda($explanada),
                        'electricidad' => $this->esMoneda($electricidad),
                        'limpieza' => $this->esMoneda($limpieza),
                        'inspeccionar' => $this->esMoneda($inspeccionar),
                        'diasAdicionales' => $this->esMoneda($diasAdicionales),
                        'subTotalServiciosBasicos' => $this->esMoneda($subTotServiciosBasicos),
                        'subTotalServicios' => $this->esMoneda($subTotServicios),
                        'subTotalOtros' => $this->esMoneda($subTotOtros),
                        'subTotalProductos' => $this->esMoneda($subTotProductos),
                        'nomServicios' => $nomServicios,
                        'subtotal' => $this->esMoneda($subtotal),
                        'iva' => $this->esMoneda($iva),
                        'total' => $this->esMoneda($total)
                    ]);
                    // --- variables gran total --
                    $granVarada+=$varada;
                    $granEstadia+=$estadia;
                    $granRampa+=$rampa;
                    $granKarcher+=$karcher;
                    $granExplanada+=$explanada;
                    $granElectricidad+=$electricidad;
                    $granLimpieza+=$limpieza;
                    $granInspeccionar+=$inspeccionar;
                    $granDiasAdicionales+=$diasAdicionales;
                    $granSubTotServiciosBasicos+=$subTotServiciosBasicos;
                    $granSubTotServicios+=$subTotServicios;
                    $granSubTotOtros+=$subTotOtros;
                    $granSubTotProductos+=$subTotProductos;
                    $granSubtotal+=$subtotal;
                    $granIva+=$iva;
                    $granTotal+=$total;
                    // ---------------------------
                    //--- Reiniciar variables ----
                    $subTotProductos = 0;
                    $subTotOtros = 0;
                    $subTotServicios = 0;
                    $subTotServiciosBasicos = 0;
                    $varada = 0;
                    $estadia = 0;
                    $rampa = 0;
                    $karcher = 0;
                    $explanada = 0;
                    $electricidad = 0;
                    $limpieza = 0;
                    $inspeccionar = 0;
                    $diasAdicionales = 0;
                    $subtotal = 0;
                    $iva = 0;
                    $total = 0;
                    $nomServicios = '';
                    $auxIdCotizacion = $servicio['idCotizacion'];
                    $folio = $servicio['foliorecotiza']?$servicio['folio'].'-'.$servicio['foliorecotiza']:$servicio['folio'];
                    $fecha = $servicio['fecha'];
                    $barco = $servicio['barco'];
                    //---------------------------
                }
                if ($servicio['otro']) {
                    $subTotOtros += $servicio['subtotal'];
                }
                if ($servicio['producto']) {
                    $subTotProductos += $servicio['subtotal'];
                }
                if ($servicio['servicio']) {
                    $subTotServicios += $servicio['subtotal'];
                    $nomServicios .= $servicio['servicio'] . '. ';
                }
                if ($servicio['servicioBasico']) {
                    $subTotServiciosBasicos += $servicio['subtotal'];
                    switch ($servicio['idServicioBasico']) {
                        case 1:$varada = $servicio['subtotal'];break;
                        case 2:$estadia = $servicio['subtotal'];break;
                        case 3:$rampa = $servicio['subtotal'];break;
                        case 4:$karcher = $servicio['subtotal'];break;
                        case 5:$explanada = $servicio['subtotal'];break;
                        case 6:$electricidad = $servicio['subtotal'];break;
                        case 7:$limpieza = $servicio['subtotal'];break;
                        case 8:$inspeccionar = $servicio['subtotal'];break;
                        case 9:$diasAdicionales = $servicio['subtotal'];break;
                    }
                }
                $subtotal += $servicio['subtotal'];
                $iva += $servicio['iva'];
                $total += $servicio['total'];
                $c++;
            }
            array_push($resultado, [
                'anio' => isset($fecha)?$fecha->format('Y'):'',
                'mes' => isset($fecha)?$fecha->format('m'):'',
                'dia' => isset($fecha)?$fecha->format('d/m/Y'):'',
                'folio' => isset($folio)?$folio:'',
                'embarcacion' => isset($barco)?$barco:'',
                'varada' => $this->esMoneda($varada),
                'estadia' => $this->esMoneda($estadia),
                'rampa' => $this->esMoneda($rampa),
                'karcher' => $this->esMoneda($karcher),
                'explanada' => $this->esMoneda($explanada),
                'electricidad' => $this->esMoneda($electricidad),
                'limpieza' => $this->esMoneda($limpieza),
                'inspeccionar' => $this->esMoneda($inspeccionar),
                'diasAdicionales' => $this->esMoneda($diasAdicionales),
                'subTotalServiciosBasicos' => $this->esMoneda($subTotServiciosBasicos),
                'subTotalServicios' => $this->esMoneda($subTotServicios),
                'subTotalOtros' => $this->esMoneda($subTotOtros),
                'subTotalProductos' => $this->esMoneda($subTotProductos),
                'nomServicios' => $nomServicios,
                'subtotal' => $this->esMoneda($subtotal),
                'iva' => $this->esMoneda($iva),
                'total' => $this->esMoneda($total)
            ]);
        }

        // --- variables gran total --
        $granVarada+=$varada;
        $granEstadia+=$estadia;
        $granRampa+=$rampa;
        $granKarcher+=$karcher;
        $granExplanada+=$explanada;
        $granElectricidad+=$electricidad;
        $granLimpieza+=$limpieza;
        $granInspeccionar+=$inspeccionar;
        $granDiasAdicionales+=$diasAdicionales;
        $granSubTotServiciosBasicos+=$subTotServiciosBasicos;
        $granSubTotServicios+=$subTotServicios;
        $granSubTotOtros+=$subTotOtros;
        $granSubTotProductos+=$subTotProductos;
        $granSubtotal+=$subtotal;
        $granIva+=$iva;
        $granTotal+=$total;
        // ---------------------------
        array_push($resultado,[
            'anio' => '',
            'mes' => '',
            'dia' => '',
            'folio' => '',
            'embarcacion' => '',
            'varada' => $this->esMoneda($granVarada),
            'estadia' => $this->esMoneda($granEstadia),
            'rampa' => $this->esMoneda($granRampa),
            'karcher' => $this->esMoneda($granKarcher),
            'explanada' => $this->esMoneda($granExplanada),
            'electricidad' => $this->esMoneda($granElectricidad),
            'limpieza' => $this->esMoneda($granLimpieza),
            'inspeccionar' => $this->esMoneda($granInspeccionar),
            'diasAdicionales' => $this->esMoneda($granDiasAdicionales),
            'subTotalServiciosBasicos' => $this->esMoneda($granSubTotServiciosBasicos),
            'subTotalServicios' => $this->esMoneda($granSubTotServicios),
            'subTotalOtros' => $this->esMoneda($granSubTotOtros),
            'subTotalProductos' => $this->esMoneda($granSubTotProductos),
            'nomServicios' => '',
            'subtotal' => $this->esMoneda($granSubtotal),
            'iva' => $this->esMoneda($granIva),
            'total' => $this->esMoneda($granTotal)
        ]);
        return $resultado;
    }

    public function getCotizacionesFromCliente($client)
    {
        $manager = $this->getEntityManager();
        $cotizaciones = $manager->createQuery(
            'SELECT cotizaciones.id, CONCAT(cotizaciones.folio, \' \', barco.nombre) AS text '.
            'FROM AppBundle:AstilleroCotizacion cotizaciones '.
            'LEFT JOIN cotizaciones.barco barco '.
            'WHERE IDENTITY(cotizaciones.cliente) = :client '.
            'AND cotizaciones.validacliente = 2')
            ->setParameter('client', $client);

        return $cotizaciones->getArrayResult();
    }
}

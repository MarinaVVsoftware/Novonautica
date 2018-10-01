<?php

namespace AppBundle\Repository;

/**
 * CombustibleRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CombustibleRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * Los metodos getCotizacionesFromCliente y getOneWithCatalogo son ambos para las facturaciones
     * muestran los folios de cotizaciones en la facturacion y generan los conceptos de la tabla
     *
     * @param $client
     *
     * @return array
     */
    public function getCotizacionesFromCliente($client)
    {
        $manager = $this->getEntityManager();
        $cotizaciones = $manager->createQuery(
            'SELECT cotizaciones.id, '.
            '(CASE '.
            'WHEN cotizaciones.foliorecotiza > 0 '.
            'THEN CONCAT(cotizaciones.folio, \'-\', cotizaciones.foliorecotiza, \' \', barco.nombre) '.
            'ELSE CONCAT(cotizaciones.folio, \' \', barco.nombre) '.
            'END) AS text '.
            'FROM AppBundle:Combustible cotizaciones '.
            'LEFT JOIN cotizaciones.barco barco '.
            'WHERE IDENTITY(cotizaciones.cliente) = :client')
            ->setParameter('client', $client);

        return $cotizaciones->getArrayResult();
    }

    public function getOneWithCatalogo($id)
    {
        $manager = $this->getEntityManager();

        $cotizacion = $manager->createQuery(
            'SELECT '.
            'cotizacion.cantidad AS conceptoCantidad, cotizacion.total AS conceptoImporte, '.
            'tipo.nombre AS conceptoDescripcion, '.
            'cps.id AS cpsId, cps.descripcion as cpsDescripcion, '.
            'cu.id AS cuId, cu.nombre AS cuDescripcion '.
            'FROM AppBundle:Combustible cotizacion '.
            'LEFT JOIN cotizacion.tipo tipo '.
            'LEFT JOIN tipo.claveProdServ cps '.
            'LEFT JOIN tipo.claveUnidad cu '.
            'WHERE cotizacion.id = :id '.
            'AND cotizacion.factura IS NULL')
            ->setParameter('id', $id)
            ->getArrayResult();

        return $cotizacion;
    }
}

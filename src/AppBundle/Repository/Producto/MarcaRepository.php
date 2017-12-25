<?php

namespace AppBundle\Repository\Producto;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
/**
 * MarcaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class MarcaRepository extends EntityRepository
{
    public function paginacion($page = 1, $length = 1, $order = 'DESC') : Paginator
    {
        $qb = $this->createQueryBuilder('ma');

        $qb
            ->addOrderBy('ma.id', $order)
            ->setFirstResult($length * ((int)$page - 1))
            ->setMaxResults($length);

        $paginator = new Paginator($qb, false);

        return $paginator;
    }
}
<?php

namespace AppBundle\Repository;
use Doctrine\ORM\EntityRepository;

/**
 * EmbarcacionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EmbarcacionRepository extends EntityRepository
{
    public function findAllLight() : array
    {
        $qb = $this->createQueryBuilder('em');

        $qb->select('em', 'ma', 'mo', 'pa')
            ->leftJoin('em.marca', 'ma')
            ->leftJoin('em.modelo', 'mo')
            ->leftJoin('em.pais', 'pa');

        return $qb->getQuery()->getResult();
    }

}
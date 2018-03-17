<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;
/**
 * ProductRepository
 */
class ProductRepository extends EntityRepository
{
    public function findActive(){
        $qb = $this->createQueryBuilder('p')
            ->join('p.categoryId', 'c')
            ->where('c.active = 1');
        return $qb->getQuery()->getResult();
    }
}

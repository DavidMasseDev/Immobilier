<?php

namespace App\Repository;

use App\Entity\Estate;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Estate>
 *
 * @method Estate|null find($id, $lockMode = null, $lockVersion = null)
 * @method Estate|null findOneBy(array $criteria, array $orderBy = null)
 * @method Estate[]    findAll()
 * @method Estate[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Estate::class);
    }

    public function findEstateWithPaginator(int $page)
    {
        $limit = 40;
        $offset = $limit * ($page - 1);

        $qb = $this->createQueryBuilder('e');
        $qb->orderBy('e.CreatedAt', 'DESC');
        $qb->setMaxResults($limit);
        $qb->setFirstResult($offset);
        $query = $qb->getQuery();

        return new Paginator($query);


    }
}

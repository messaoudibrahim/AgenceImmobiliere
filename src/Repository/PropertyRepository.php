<?php

namespace App\Repository;

use App\Entity\Property;
use App\Entity\PropertySearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Property::class);
    }

    public function findLatest()
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.sold = false')
            ->orderBy('p.create_at', 'ASC')
            ->setMaxResults(4)
            ->getQuery()
            ->getResult()
        ;
    }


    /**
     * @param  PropertySearch $poSearch
     * @return QueryBuilder
     */
    public function getBienVisible(PropertySearch $poSearch): QueryBuilder
    {

        $loQuery =  $this->createQueryBuilder('p');

        if ($poSearch->getMaxPrice()){
            $loQuery->andWhere('p.price <= :price')
                ->setParameter('price' , $poSearch->getMaxPrice());
        }

        if ($poSearch->getMinSurface()){
            $loQuery->andWhere('p.surface >= :surface')
                ->setParameter('surface' , $poSearch->getMinSurface());
        }


        $loQuery->andWhere('p.sold = :sold')
            ->setParameter('sold', false);
        return $loQuery;

    }

}

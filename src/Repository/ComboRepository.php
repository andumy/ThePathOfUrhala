<?php

namespace App\Repository;

use App\Entity\Combo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Combo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Combo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Combo[]    findAll()
 * @method Combo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ComboRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Combo::class);
    }

    // /**
    //  * @return Combo[] Returns an array of Combo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */


    /**
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function findOneByIngredients(string $firstIngredient, string $secondIngredient)
    {
        $qb = $this->createQueryBuilder('c');
        $qb->where(
            $qb->expr()->orX(
                $qb->expr()->andX(
                    $qb->expr()->eq('c.firstIngredient', ':firstIngredient'),
                    $qb->expr()->eq('c.secondIngredient', ':secondIngredient'),
                ),
                $qb->expr()->andX(
                    $qb->expr()->eq('c.firstIngredient', ':secondIngredient'),
                    $qb->expr()->eq('c.secondIngredient', ':firstIngredient'),
                )
            )
        )
            ->setParameter('firstIngredient', $firstIngredient)
            ->setParameter('secondIngredient', $secondIngredient);

        return $qb->getQuery()->getOneOrNullResult();
    }

}

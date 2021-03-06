<?php

namespace App\Repository;

use App\Entity\ContactForm;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ContactForm|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactForm|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactForm[]    findAll()
 * @method ContactForm[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactFormRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ContactForm::class);
    }

    public function fetchDepartmentName($value)
    {

        return $this->createQueryBuilder('c')
            ->join('c.departement', 'd')
            ->andWhere('d.id=:val')
            ->setParameter('val', $value)
            ->select('d.nom')
            ->getQuery()
            ->getResult()
        ;
    }

    public function fetchDepartmentEmail($value)
    {

        return $this->createQueryBuilder('c')
            ->join('c.departement', 'd')
            ->andWhere('d.id = :val')
            ->setParameter('val', $value)
            ->select('d.email')
            ->getQuery()
            ->getResult()
        ;
    }

    // /**
    //  * @return ContactForm[] Returns an array of ContactForm objects
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

    /*
    public function findOneBySomeField($value): ?ContactForm
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

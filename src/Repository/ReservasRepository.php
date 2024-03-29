<?php

namespace App\Repository;

use App\Entity\Reservas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Reservas>
 *
 * @method Reservas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservas[]    findAll()
 * @method Reservas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservas::class);
    }

    //    /**
    //     * @return Reservas[] Returns an array of Reservas objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('r.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Reservas
    //    {
    //        return $this->createQueryBuilder('r')
    //            ->andWhere('r.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

    public function selectReservas(): array {
        return $this->createQueryBuilder("reservas")
            ->select()
            ->getQuery()
            ->getResult();
    }


    public function joinDos(): array {
        return $this->createQueryBuilder("reservas")
            ->innerJoin("reservas.reviews", "rev")
            ->select("reservas.cliente, rev.comentario, rev.nota_valoracion")
            ->where("reservas.activo = :activo AND rev.activo = :activo")
            ->setParameter("activo", true)
            ->orderBy("reservas.cliente", "ASC")
            ->getQuery()
            ->getResult();
    }


}

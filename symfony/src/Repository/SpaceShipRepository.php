<?php

namespace App\Repository;

use App\Entity\SpaceShip;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method SpaceShip|null find($id, $lockMode = null, $lockVersion = null)
 * @method SpaceShip|null findOneBy(array $criteria, array $orderBy = null)
 * @method SpaceShip[]    findAll()
 * @method SpaceShip[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SpaceShipRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, SpaceShip::class);
    }
}

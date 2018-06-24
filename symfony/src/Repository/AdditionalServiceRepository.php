<?php

namespace App\Repository;

use App\Entity\AdditionalService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AdditionalService|null find($id, $lockMode = null, $lockVersion = null)
 * @method AdditionalService|null findOneBy(array $criteria, array $orderBy = null)
 * @method AdditionalService[]    findAll()
 * @method AdditionalService[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdditionalServiceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AdditionalService::class);
    }
}

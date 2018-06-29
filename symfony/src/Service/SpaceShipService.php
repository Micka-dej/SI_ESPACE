<?php

namespace App\Service;

use App\Entity\SpaceShip;
use App\Entity\User;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Handles all logical operations related to the API activites.
 *
 * Operated mainly on serialization/deserialization, JSON and API response
 *
 * @todo Add methods for PUT
 */
class SpaceShipService
{
    /**
     * Serializer generator.
     *
     * @return Serializer Serializer instance
     */
    public function generateSerializer(): Serializer
    {
        $encoders = [new JsonEncoder()];
        $objectNormalizer = new ObjectNormalizer();
        $objectNormalizer->setCircularReferenceLimit(1);
        $objectNormalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $normalizers = [new DateTimeNormalizer('d-m-Y H:i:s', new \DateTimeZone('Europe/Paris')), $objectNormalizer];

        return new Serializer($normalizers, $encoders);
    }

    /**
     * Deserialize JSON encoded datas to SpaceShip entity instance.
     *
     * @param string $data JSON Serialized SpaceShip entity
     * @param User   $user Proprietary
     *
     * @return SpaceShip
     */
    public function generateSpaceShipFromJSON(string $data, User $user): SpaceShip
    {
        /** @var SpaceShip $spaceship */
        $spaceship = $this->generateSerializer()->deserialize($data, SpaceShip::class, 'json');
        $spaceship->setRelatedUser($user);

        return $spaceship;
    }
}

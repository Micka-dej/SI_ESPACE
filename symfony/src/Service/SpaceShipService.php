<?php

namespace App\Service;

use App\Entity\SpaceShip;
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
        $normalizers = [new DateTimeNormalizer('d-m-Y H:i:s', new \DateTimeZone('Europe/Paris')), $objectNormalizer];

        return new Serializer($normalizers, $encoders);
    }

    /**
     * Deserialize JSON encoded datas to SpaceShip entity instance.
     *
     * @param string $data JSON Serialized SpaceShip entity
     *
     * @return SpaceShip
     */
    public function generateSpaceShipFromJSON(string $data): SpaceShip
    {
        /** @var SpaceShip $user */
        $user = $this->generateSerializer()->deserialize($data, SpaceShip::class, 'json');

        return $user;
    }
}

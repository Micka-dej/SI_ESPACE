<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
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
class UserService
{
    /**
     * @var UserPasswordEncoderInterface Autowired UserPasswordEncoder service
     */
    private $passwordEncoder;

    /**
     * APIService constructor.
     *
     * @param UserPasswordEncoderInterface $passwordEncoder Autowired UserPasswordEncoder service
     */
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * Serializer generator.
     *
     * Allows to generate a serializer already including the UUIDSerializerHandler in the registered handlers
     *
     * @param bool $isCreationSerializer
     *
     * @return Serializer Serializer instance
     */
    public function generateSerializer(bool $isCreationSerializer = false): Serializer
    {
        $encoders = [new JsonEncoder()];
        $objectNormalizer = new ObjectNormalizer();
        if ($isCreationSerializer) {
            $objectNormalizer->setIgnoredAttributes(['password', 'salt']);
        } else {
            $objectNormalizer->setIgnoredAttributes(['password', 'salt', 'plainPassword']);
        }
        $normalizers = [new DateTimeNormalizer('d-m-Y H:i:s', new \DateTimeZone('Europe/Paris')), $objectNormalizer];

        return new Serializer($normalizers, $encoders);
    }

    /**
     * Deserialize JSON encoded datas to AppUser entity instance.
     *
     * @param string $data JSON Serialized AppUser entity
     *
     * @return User
     */
    public function generateAppUserFromJSON(string $data): User
    {
        $user = $this->generateSerializer(true)->deserialize($data, User::class, 'json');
        /** @var User $user */
        $password = $this->passwordEncoder->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($password);
        $user->setCreationTime(new \DateTime());

        return $user;
    }

    /**
     * Used in patch method to update an existing user.
     *
     * @param User   $user User to update
     * @param string $data JSON string with patch datas
     *
     * @return User
     */
    public function mergeEntityFromJSON(User $user, string $data): User
    {
        $this->generateSerializer()->deserialize($data, User::class, 'json', ['object_to_populate' => $user]);
        if (null !== $user->getPlainPassword()) {
            $password = $this->passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
        } else {
            /* @todo Plain password placeholder is pretty shitty, find a better way to handle validation passing when password is not updated */
            $user->setPlainPassword('Placeholder');
        }

        return $user;
    }
}

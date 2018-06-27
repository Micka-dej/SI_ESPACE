<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity("email", message="Cet adresse e-mail existe déjà")
 * @UniqueEntity("username", message="Ce nom d'utilisateur existe déjà")
 * @UniqueEntity("phoneNumber", message="Ce numéro de téléphone existe déjà")
 */
class User implements UserInterface, \Serializable
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @var null|int
     */
    private $id;

    /**
     * User's last name.
     *
     * @ORM\Column(type="string", length=50)
     *
     * @var null|string
     *
     * @Assert\NotBlank(message="Vous devez renseigner un nom de famille")
     * @Assert\Length(max="50", maxMessage="Le nom de famille ne peut excéder {{ limit }} caractères.")
     */
    private $lastName;

    /**
     * User's first name.
     *
     * @ORM\Column(type="string", length=50)
     *
     * @var null|string
     *
     * @Assert\NotBlank(message="Vous devez renseigner un prénom")
     * @Assert\Length(max="50", maxMessage="Le prénom ne peut excéder {{ limit }} caractères.")
     */
    private $firstName;

    /**
     * User's email address.
     *
     * @ORM\Column(type="string", length=30, unique=true)
     *
     * @var null|string
     *
     * @Assert\NotBlank(message="Vous devez renseigner un e-mail")
     * @Assert\Email(
     *     message = "L'adresse e-mail '{{ value }}' n'est pas valide."
     * )
     */
    private $email;

    /**
     * The planet whose the user comes from.
     *
     * @ORM\Column(type="string", length=20)
     *
     * @var null|string
     *
     * @Assert\NotBlank(message="Vous devez renseigner une planète d'origine")
     * @Assert\Length(max="20", maxMessage="Le nom de la planète d'origine ne peut excéder {{ limit }} caractères.")
     */
    private $planet;

    /**
     * User's username.
     *
     * @ORM\Column(type="string", length=30, unique=true)
     *
     * @var null|string
     *
     * @Assert\NotBlank(message="Vous devez renseigner un nom d'utilisateur")
     * @Assert\Length(max="30", maxMessage="Le nom d'utilisateur d'origine ne peut excéder {{ limit }} caractères.")
     */
    private $username;

    /**
     * User's phone number.
     *
     * @ORM\Column(type="string", length=20, unique=true)
     *
     * @var null|string
     *
     * @Assert\NotBlank(message="Vous devez renseigner un numéro de téléphone")
     * @Assert\Length(max="20", maxMessage="Le numéro de téléphone ne peut excéder {{ limit }} caractères.")
     */
    private $phoneNumber;

    /**
     * User's password.
     *
     * @ORM\Column(type="string", length=64)
     *
     * @var null|string
     */
    private $password;

    /**
     * User's credits.
     *
     * @ORM\Column(type="integer")
     *
     * @var null|int
     *
     * @Assert\NotBlank(message="Vous devez renseigner un nombre de crédits")
     * @Assert\GreaterThanOrEqual(
     *     value = 0
     * )
     */
    private $credits;

    /**
     * User's bills.
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Order", mappedBy="user")
     *
     * @var Order[]
     */
    private $ordersBill;

    /**
     * @ORM\Column(name="is_active", type="boolean")
     *
     * @var null|bool
     */
    private $isActive;

    /**
     * User creation time.
     *
     * @var \DateTime
     *
     * @ORM\Column(name="creation_time", type="datetime")
     */
    private $creationTime;

    /**
     * User's plain password (not stored in database, only used at registration).
     *
     * @var null|string
     *
     * @Assert\NotBlank(message="Vous devez renseigner un mot de passe")
     * @Assert\Length(min="5", max="4096", minMessage="Le mot de passe doit faire plus de {{ limit }} caractères", maxMessage="Le mot de passe ne peut excéder {{ limit }} caractères.")
     */
    private $plainPassword;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SpaceShip", mappedBy="relatedUser")
     */
    private $spaceShips;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->ordersBill = new ArrayCollection();
        $this->isActive = true;
        $this->creationTime = new \DateTime();
        $this->spaceShips = new ArrayCollection();
    }

    /**
     * ID getter.
     *
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * LastName getter.
     *
     * @return null|string
     */
    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    /**
     * LastName setter.
     *
     * @param string $lastName
     *
     * @return User
     */
    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * FirstName getter.
     *
     * @return null|string
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * FirstName setter.
     *
     * @param string $firstName
     *
     * @return User
     */
    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Email getter.
     *
     * @return null|string
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * Email setter.
     *
     * @param string $email
     *
     * @return User
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Planet getter.
     *
     * @return null|string
     */
    public function getPlanet(): ?string
    {
        return $this->planet;
    }

    /**
     * planet setter.
     *
     * @param string $planet
     *
     * @return User
     */
    public function setPlanet(string $planet): self
    {
        $this->planet = $planet;

        return $this;
    }

    /**
     * Username getter.
     *
     * @return null|string
     */
    public function getUsername(): ?string
    {
        return $this->username;
    }

    /**
     * Username setter.
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Phone Number getter.
     *
     * @return string|null
     */
    public function getPhoneNumber(): ?string
    {
        return $this->phoneNumber;
    }

    /**
     * Phone Number setter.
     *
     * @param string $phoneNumber
     *
     * @return User
     */
    public function setPhoneNumber(string $phoneNumber): self
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Password getter.
     *
     * @return null|string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * Password setter.
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Credits getter.
     *
     * @return int|null
     */
    public function getCredits(): ?int
    {
        return $this->credits;
    }

    /**
     * Credits setter.
     *
     * @param int $credits
     *
     * @return User
     */
    public function setCredits(int $credits): self
    {
        $this->credits = $credits;

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getOrdersBill(): Collection
    {
        return $this->ordersBill;
    }

    /**
     * @param Order $ordersBill
     *
     * @return User
     */
    public function addOrdersBill(Order $ordersBill): self
    {
        if (!$this->ordersBill->contains($ordersBill)) {
            $this->ordersBill[] = $ordersBill;
            $ordersBill->setUser($this);
        }

        return $this;
    }

    /**
     * @param Order $ordersBill
     *
     * @return User
     */
    public function removeOrdersBill(Order $ordersBill): self
    {
        if ($this->ordersBill->contains($ordersBill)) {
            $this->ordersBill->removeElement($ordersBill);
            // set the owning side to null (unless already changed)
            if ($ordersBill->getUser() === $this) {
                $ordersBill->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password,
        ]);
    }

    /**
     * @param string $serialized
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->password) = unserialize($serialized);
    }

    /**
     * @return string[]
     */
    public function getRoles(): array
    {
        return ['ROLE_ADMIN'];
    }

    /**
     * No need to salt with bcrypt, already handled by the encoder.
     *
     * @see http://php.net/manual/fr/function.password-hash.php
     * @see https://fr.wikipedia.org/wiki/Salage_(cryptographie)
     *
     * @return null|string
     */
    public function getSalt(): ?string
    {
        return null;
    }

    public function eraseCredentials(): void
    {
        $this->plainPassword = null;
    }

    /**
     * @return null|bool
     */
    public function isActive(): ?bool
    {
        return $this->isActive;
    }

    /**
     * @param mixed $isActive
     *
     * @return User
     */
    public function setIsActive($isActive): self
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getCreationTime(): \DateTime
    {
        return $this->creationTime;
    }

    /**
     * @param \DateTime $creationTime
     *
     * @return User
     */
    public function setCreationTime(\DateTime $creationTime): self
    {
        $this->creationTime = $creationTime;

        return $this;
    }

    /**
     * @return string
     */
    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    /**
     * @param string $plainPassword
     *
     * @return User
     */
    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * @return Collection|SpaceShip[]
     */
    public function getSpaceShips(): Collection
    {
        return $this->spaceShips;
    }

    public function addSpaceShip(SpaceShip $spaceShip): self
    {
        if (!$this->spaceShips->contains($spaceShip)) {
            $this->spaceShips[] = $spaceShip;
            $spaceShip->setRelatedUser($this);
        }

        return $this;
    }

    public function removeSpaceShip(SpaceShip $spaceShip): self
    {
        if ($this->spaceShips->contains($spaceShip)) {
            $this->spaceShips->removeElement($spaceShip);
            // set the owning side to null (unless already changed)
            if ($spaceShip->getRelatedUser() === $this) {
                $spaceShip->setRelatedUser(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $id;

    /**
     * User's last name.
     *
     * @ORM\Column(type="string", length=50)
     *
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="50", maxMessage="User's last name must not exceed {{ limit }} characters.")
     */
    private $lastName;

    /**
     * User's first name.
     *
     * @ORM\Column(type="string", length=50)
     *
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="50", maxMessage="User's first name must not exceed {{ limit }} characters.")
     */
    private $firstName;

    /**
     * User's email address.
     *
     * @ORM\Column(type="string", length=30)
     *
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Email(
     *     message = "The email '{{ value }}' is not a valid email.",
     *     checkMX = true
     * )
     */
    private $email;

    /**
     * The planet whose the user comes from.
     *
     * @ORM\Column(type="string", length=20)
     *
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="20", maxMessage="User's planet must not exceed {{ limit }} characters.")
     */
    private $planet;

    /**
     * User's username.
     *
     * @ORM\Column(type="string", length=30)
     *
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="30", maxMessage="User's username must not exceed {{ limit }} characters.")
     */
    private $username;

    /**
     * User's phone number.
     *
     * @ORM\Column(type="string", length=20)
     *
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="20", maxMessage="User's phone number must not exceed {{ limit }} characters.")
     */
    private $phoneNumber;

    /**
     * User's password.
     *
     * @ORM\Column(type="string", length=60)
     *
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="60", maxMessage="User's password must not exceed {{ limit }} characters.")
     */
    private $password;

    /**
     * User's credits.
     *
     * @ORM\Column(type="integer")
     *
     * @var int
     *
     * @Assert\NotBlank()
     * @Assert\GreaterThanOrEqual(
     *     value = 0
     * )
     */
    private $credits;

    /**
     * User's bills.
     *
     * @ORM\OneToMany(targetEntity="App\Entity\Order", mappedBy="user")
     */
    private $ordersBill;

    public function __construct()
    {
        $this->ordersBill = new ArrayCollection();
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

    public function addOrdersBill(Order $ordersBill): self
    {
        if (!$this->ordersBill->contains($ordersBill)) {
            $this->ordersBill[] = $ordersBill;
            $ordersBill->setUser($this);
        }

        return $this;
    }

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
}

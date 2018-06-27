<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SpaceShipRepository")
 */
class SpaceShip
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
     * Spaceship matricule (unique identifier).
     *
     * @ORM\Column(type="string", length=30)
     *
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="30", maxMessage="Spaceship matricule must not exceed {{ limit }} characters.")
     */
    private $matricule;

    /**
     * Type of energy used by the spaceship.
     *
     * @ORM\Column(type="string", length=20)
     *
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="20", maxMessage="Top of fuel must not exceed {{ limit }} characters.")
     */
    private $fuelType;

    /**
     * Spaceship size.
     *
     * @ORM\Column(type="string", length=30)
     *
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Length(max="30", maxMessage="Spaceship size must not exceed {{ limit }} characters.")
     */
    private $size;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Order", mappedBy="spaceship")
     */
    private $orders;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="spaceShips")
     */
    private $relatedUser;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
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
     * Matricule getter.
     *
     * @return null|string
     */
    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    /**
     * Matricule setter.
     *
     * @param string $matricule
     *
     * @return SpaceShip
     */
    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    /**
     * FuelType getter.
     *
     * @return null|string
     */
    public function getFuelType(): ?string
    {
        return $this->fuelType;
    }

    /**
     * FuelType setter.
     *
     * @param string $fuelType
     *
     * @return SpaceShip
     */
    public function setFuelType(string $fuelType): self
    {
        $this->fuelType = $fuelType;

        return $this;
    }

    /**
     * Size getter.
     *
     * @return null|string
     */
    public function getSize(): ?string
    {
        return $this->size;
    }

    /**
     * Size setter.
     *
     * @param string $size
     *
     * @return SpaceShip
     */
    public function setSize(string $size): self
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return Collection|Order[]
     */
    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function addOrder(Order $order): self
    {
        if (!$this->orders->contains($order)) {
            $this->orders[] = $order;
            $order->setSpaceship($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->contains($order)) {
            $this->orders->removeElement($order);
            // set the owning side to null (unless already changed)
            if ($order->getSpaceship() === $this) {
                $order->setSpaceship(null);
            }
        }

        return $this;
    }

    public function getRelatedUser(): ?User
    {
        return $this->relatedUser;
    }

    public function setRelatedUser(?User $relatedUser): self
    {
        $this->relatedUser = $relatedUser;

        return $this;
    }
}

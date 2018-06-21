<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use DateTimeInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\OrderRepository")
 */
class Order
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
     * Starting date of the stay
     *
     * @ORM\Column(type="datetime")
     *
     * @var DateTimeInterface
     */
    private $startingDate;

    /**
     * Ending date of the stay
     *
     * @ORM\Column(type="datetime")
     *
     * @var DateTimeInterface
     */
    private $endingDate;

    /**
     * Additional services ordered
     *
     * @ORM\ManyToMany(targetEntity="App\Entity\AdditionalService", inversedBy="orders")
     */
    private $additionalServices;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SpaceShip", inversedBy="orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $spaceship;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="ordersBill")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * Order constructor.
     */
    public function __construct()
    {
        $this->additionalServices = new ArrayCollection();
    }

    /**
     * ID getter
     *
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Spaceship getter
     *
     * @return SpaceShip|null
     */
    public function getSpaceship(): ?SpaceShip
    {
        return $this->spaceship;
    }

    /**
     * Spaceship setter
     *
     * @param SpaceShip|null $spaceship
     *
     * @return Order
     */
    public function setSpaceship(?SpaceShip $spaceship): self
    {
        $this->spaceship = $spaceship;

        return $this;
    }

    /**
     * StartingDate getter
     *
     * @return \DateTimeInterface|null
     */
    public function getStartingDate(): ?\DateTimeInterface
    {
        return $this->startingDate;
    }

    /**
     * StartingDate setter
     *
     * @param \DateTimeInterface $startingDate
     *
     * @return Order
     */
    public function setStartingDate(\DateTimeInterface $startingDate): self
    {
        $this->startingDate = $startingDate;

        return $this;
    }

    /**
     * EndingDate getter
     *
     * @return \DateTimeInterface|null
     */
    public function getEndingDate(): ?\DateTimeInterface
    {
        return $this->endingDate;
    }

    /**
     * EndingDate setter
     *
     * @param \DateTimeInterface $endingDate
     *
     * @return Order
     */
    public function setEndingDate(\DateTimeInterface $endingDate): self
    {
        $this->endingDate = $endingDate;

        return $this;
    }

    /**
     * @return Collection|AdditionalService[]
     */
    public function getAdditionalServices(): Collection
    {
        return $this->additionalServices;
    }

    /**
     * AdditionalService add
     *
     * @param AdditionalService $additionalService
     *
     * @return Order
     */
    public function addAdditionalService(AdditionalService $additionalService): self
    {
        if (!$this->additionalServices->contains($additionalService)) {
            $this->additionalServices[] = $additionalService;
        }

        return $this;
    }

    /**
     * AdditionalSerice remove
     *
     * @param AdditionalService $additionalService
     *
     * @return Order
     */
    public function removeAdditionalService(AdditionalService $additionalService): self
    {
        if ($this->additionalServices->contains($additionalService)) {
            $this->additionalServices->removeElement($additionalService);
        }

        return $this;
    }

    /**
     * @param string $diffFormat
     *
     * @return int
     */
    public function dateDifference(string $diffFormat = '%d'): int
    {
        $interval = date_diff($this->startingDate, $this->endingDate);

        return $interval->format($diffFormat);
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }
}

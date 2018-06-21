<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ParkingRepository")
 * @ORM\Table(name="space_parking")
 */
class Parking
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
     * Parking matricule (unique identifier).
     *
     * @ORM\Column(type="string", length=30)
     *
     * @var string
     */
    private $matricule;

    /**
     * Maximal allowed spaceship size.
     *
     * @ORM\Column(type="string", length=30)
     *
     * @var string
     */
    private $allowedSize;

    /**
     * Total number of slots.
     *
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $slots;

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
     * @return Parking
     */
    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    /**
     * AllowedSize getter.
     *
     * @return null|string
     */
    public function getAllowedSize(): ?string
    {
        return $this->allowedSize;
    }

    /**
     * AllowedSize setter.
     *
     * @param string $allowedSize
     *
     * @return Parking
     */
    public function setAllowedSize(string $allowedSize): self
    {
        $this->allowedSize = $allowedSize;

        return $this;
    }

    /**
     * Slots getter.
     *
     * @return int|null
     */
    public function getSlots(): ?int
    {
        return $this->slots;
    }

    /**
     * Slots setter.
     *
     * @param int $slots
     *
     * @return Parking
     */
    public function setSlots(int $slots): self
    {
        $this->slots = $slots;

        return $this;
    }
}

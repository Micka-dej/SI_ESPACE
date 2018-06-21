<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AdditionalServiceRepository")
 * @ORM\Table(name="space_additional_service")
 */
class AdditionalService
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
     * Name of the service
     *
     * @ORM\Column(type="string", length=30)
     *
     * @var string
     */
    private $name;

    /**
     * Description of the service
     *
     * @ORM\Column(type="text")
     *
     * @var string
     */
    private $description;

    /**
     * Price of the service
     *
     * @ORM\Column(type="integer")
     *
     * @var int
     */
    private $price;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Order", mappedBy="additionalServices")
     */
    private $orders;

    public function __construct()
    {
        $this->orders = new ArrayCollection();
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
     * Name getter
     *
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * Name setter
     *
     * @param string $name
     *
     * @return AdditionalServices
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Description getter
     *
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * Description setter
     *
     * @param string $description
     *
     * @return AdditionalServices
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Price getter
     *
     * @return int|null
     */
    public function getPrice(): ?int
    {
        return $this->price;
    }

    /**
     * Price setter
     *
     * @param int $price
     *
     * @return AdditionalServices
     */
    public function setPrice(int $price): self
    {
        $this->price = $price;

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
            $order->addAdditionalService($this);
        }

        return $this;
    }

    public function removeOrder(Order $order): self
    {
        if ($this->orders->contains($order)) {
            $this->orders->removeElement($order);
            $order->removeAdditionalService($this);
        }

        return $this;
    }
}

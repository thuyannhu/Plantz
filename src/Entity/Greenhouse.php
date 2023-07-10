<?php

namespace App\Entity;

use App\Repository\GreenhouseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GreenhouseRepository::class)]
class Greenhouse
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Booking::class, mappedBy: 'greenhouseId')]
    private Collection $bookingId;

    #[ORM\Column]
    private ?int $light = null;

    #[ORM\Column]
    private ?int $humidity = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    public function __construct()
    {
        $this->bookingId = new ArrayCollection();
    }

    public function __toString(): string
    {
        return $this->name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Booking>
     */
    public function getBookingId(): Collection
    {
        return $this->bookingId;
    }

    public function addBookingId(Booking $bookingId): self
    {
        if (!$this->bookingId->contains($bookingId)) {
            $this->bookingId->add($bookingId);
            $bookingId->addGreenhouseId($this);
        }

        return $this;
    }

    public function removeBookingId(Booking $bookingId): self
    {
        if ($this->bookingId->removeElement($bookingId)) {
            $bookingId->removeGreenhouseId($this);
        }

        return $this;
    }

    public function getLight(): ?int
    {
        return $this->light;
    }

    public function setLight(int $light): self
    {
        $this->light = $light;

        return $this;
    }

    public function getHumidity(): ?int
    {
        return $this->humidity;
    }

    public function setHumidity(int $humidity): self
    {
        $this->humidity = $humidity;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\BookingRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookingRepository::class)]
class Booking
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToMany(targetEntity: Greenhouse::class, inversedBy: 'bookingId')]
    private Collection $greenhouseId;

    #[ORM\Column(length: 255)]
    private ?\DateTime $arrivalDate = null;

    #[ORM\Column(length: 255)]
    private ?\DateTime $departureDate = null;

    #[ORM\Column]
    private ?bool $isOnsite = null;

    #[ORM\ManyToOne(inversedBy: 'bookings')]
    private ?User $user = null;

    public function __construct()
    {
        $this->greenhouseId = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection<int, Greenhouse>
     */
    public function getGreenhouseId(): Collection
    {
        return $this->greenhouseId;
    }

    public function addGreenhouseId(Greenhouse $greenhouseId): self
    {
        if (!$this->greenhouseId->contains($greenhouseId)) {
            $this->greenhouseId->add($greenhouseId);
        }

        return $this;
    }

    public function removeGreenhouseId(Greenhouse $greenhouseId): self
    {
        $this->greenhouseId->removeElement($greenhouseId);

        return $this;
    }

    public function getGreenhouseNames(): Collection
    {
        return $this->greenhouseId->map(function ($greenhouse) {
            return $greenhouse->getName();
        });
    }

    public function addGreenhouseName(string $name): self
{
    if (!$this->greenhouseId->exists(function ($key, $greenhouse) use ($name) {
        return $greenhouse->getName() === $name;
    })) {
        $this->greenhouseId->add(new Greenhouse($name));
    }

    return $this;
}

public function removeGreenhouseName(string $name): self
{
    $this->greenhouseId->filter(function ($greenhouse) use ($name) {
        return $greenhouse->getName() === $name;
    })->map(function ($greenhouse) {
        $this->greenhouseId->removeElement($greenhouse);
    });

    return $this;
}

    public function getArrivalDate(): ?\DateTime
    {
        return $this->arrivalDate;
    }

    public function setArrivalDate(\DateTime $arrivalDate): self
    {
        $this->arrivalDate = $arrivalDate;

        return $this;
    }

    public function getDepartureDate(): ?\DateTime
    {
        return $this->departureDate;
    }

    public function setDepartureDate(\DateTime $departureDate): self
    {
        $this->departureDate = $departureDate;

        return $this;
    }

    public function isIsOnsite(): ?bool
    {
        return $this->isOnsite;
    }

    public function setIsOnsite(bool $isOnsite): self
    {
        $this->isOnsite = $isOnsite;

        return $this;
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

    public function getUserFullName(): ?string
    {
        $user = $this->getUser();
        return $user->getFullName();
    }
}

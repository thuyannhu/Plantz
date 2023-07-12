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

    #[ORM\ManyToMany(targetEntity: Greenhouse::class, inversedBy: 'bookings')]
    private Collection $greenhouses;

    #[ORM\Column(length: 255)]
    private ?\DateTime $arrivalDate = null;

    #[ORM\Column(length: 255)]
    private ?\DateTime $departureDate = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'bookings')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function __construct()
    {
        $this->greenhouses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getGreenhouses(): Collection
    {
        return $this->greenhouses;
    }

    public function addGreenhouse(Greenhouse $greenhouse): self
    {
        if (!$this->greenhouses->contains($greenhouse)) {
            $this->greenhouses->add($greenhouse);
        }

        return $this;
    }

    public function removeGreenhouse(Greenhouse $greenhouse): self
    {
        $this->greenhouses->removeElement($greenhouse);

        return $this;
    }

    public function getUserName(): ?string
    {
        $user = $this->getUser();
        return $user->getName();
    }

    public function getUserSurname(): ?string
    {
        $user = $this->getUser();
        return $user->getSurname();
    }

    public function setUserName(string $name): void
    {
        $user = $this->getUser();
        $user->setName($name);
    }

    public function setUserSurname(string $surname): void
    {
        $user = $this->getUser();
        $user->setSurname($surname);
    }

    public function getUserFullName(): ?string
    {
        $user = $this->getUser();
        return $user->getFullName();
    }
} 
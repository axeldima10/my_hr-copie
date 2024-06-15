<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\VirtualUserRepository;
use Doctrine\ORM\Mapping\InheritanceType;
use Doctrine\ORM\Mapping\DiscriminatorMap;
use Doctrine\ORM\Mapping\DiscriminatorColumn;

#[ORM\Entity(repositoryClass: VirtualUserRepository::class)]

#[InheritanceType("JOINED")]
#[DiscriminatorColumn("discr")]
#[DiscriminatorMap([
   "admin"=>"Admin",
   "jobseeker"=>"JobSeeker"
])]

class VirtualUser
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    #[ORM\Column(length: 255)]
    protected ?string $LastName = null;

    #[ORM\Column(length: 255)]
    protected ?string $FirstName = null;

    #[ORM\Column(length: 255)]
    protected ?string $tel = null;

    #[ORM\Column(length: 255)]
    protected ?string $email = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->LastName;
    }

    public function setLastName(string $LastName): static
    {
        $this->LastName = $LastName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): static
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getTel(): ?string
    {
        return $this->tel;
    }

    public function setTel(string $tel): static
    {
        $this->tel = $tel;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\JobSeekerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: JobSeekerRepository::class)]
class JobSeeker extends VirtualUser
{


    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $submittingDate = null;

    /**
     * @var Collection<int, Apply>
     */
    #[ORM\OneToMany(targetEntity: Apply::class, mappedBy: 'jobSeeker')]
    private Collection $applies;

    public function __construct()
    {
        $this->applies = new ArrayCollection();
        $this->submittingDate = new \DateTime("now");
    }

    


    public function getSubmittingDate(): ?\DateTimeInterface
    {
        return $this->submittingDate;
    }

    public function setSubmittingDate(\DateTimeInterface $submittingDate): static
    {
        $this->submittingDate = $submittingDate;

        return $this;
    }

    /**
     * @return Collection<int, Apply>
     */
    public function getApplies(): Collection
    {
        return $this->applies;
    }

    public function addApply(Apply $apply): static
    {
        if (!$this->applies->contains($apply)) {
            $this->applies->add($apply);
            $apply->setJobSeeker($this);
        }

        return $this;
    }

    public function removeApply(Apply $apply): static
    {
        if ($this->applies->removeElement($apply)) {
            // set the owning side to null (unless already changed)
            if ($apply->getJobSeeker() === $this) {
                $apply->setJobSeeker(null);
            }
        }

        return $this;
    }
}

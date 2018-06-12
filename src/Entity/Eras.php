<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ErasRepository")
 */
class Eras
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $era;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Periods", mappedBy="era", orphanRemoval=true)
     */
    private $periods;

    public function __construct()
    {
        $this->periods = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEra(): ?string
    {
        return $this->era;
    }

    public function setEra(string $era): self
    {
        $this->era = $era;

        return $this;
    }

    /**
     * @return Collection|Periods[]
     */
    public function getPeriods(): Collection
    {
        return $this->periods;
    }

    public function addPeriod(Periods $period): self
    {
        if (!$this->periods->contains($period)) {
            $this->periods[] = $period;
            $period->setEra($this);
        }

        return $this;
    }

    public function removePeriod(Periods $period): self
    {
        if ($this->periods->contains($period)) {
            $this->periods->removeElement($period);
            // set the owning side to null (unless already changed)
            if ($period->getEra() === $this) {
                $period->setEra(null);
            }
        }

        return $this;
    }
}

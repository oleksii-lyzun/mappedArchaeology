<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CulturesRepository")
 */
class Cultures
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
    private $culture;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Periods", inversedBy="cultures")
     */
    private $period;

    public function __construct()
    {
        $this->period = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getCulture(): ?string
    {
        return $this->culture;
    }

    public function setCulture(string $culture): self
    {
        $this->culture = $culture;

        return $this;
    }

    /**
     * @return Collection|Periods[]
     */
    public function getPeriod(): Collection
    {
        return $this->period;
    }

    public function addPeriod(Periods $period): self
    {
        if (!$this->period->contains($period)) {
            $this->period[] = $period;
        }

        return $this;
    }

    public function removePeriod(Periods $period): self
    {
        if ($this->period->contains($period)) {
            $this->period->removeElement($period);
        }

        return $this;
    }
}

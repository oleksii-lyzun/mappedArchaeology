<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PeriodsRepository")
 */
class Periods
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
    private $period;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Eras", inversedBy="periods")
     * @ORM\JoinColumn(nullable=false)
     */
    private $era;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Cultures", mappedBy="period")
     */
    private $cultures;

    public function __construct()
    {
        $this->cultures = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getPeriod(): ?string
    {
        return $this->period;
    }

    public function setPeriod(string $period): self
    {
        $this->period = $period;

        return $this;
    }

    public function getEra(): ?Eras
    {
        return $this->era;
    }

    public function setEra(?Eras $era): self
    {
        $this->era = $era;

        return $this;
    }

    /**
     * @return Collection|Cultures[]
     */
    public function getCultures(): Collection
    {
        return $this->cultures;
    }

    public function addCulture(Cultures $culture): self
    {
        if (!$this->cultures->contains($culture)) {
            $this->cultures[] = $culture;
            $culture->addPeriod($this);
        }

        return $this;
    }

    public function removeCulture(Cultures $culture): self
    {
        if ($this->cultures->contains($culture)) {
            $this->cultures->removeElement($culture);
            $culture->removePeriod($this);
        }

        return $this;
    }
}

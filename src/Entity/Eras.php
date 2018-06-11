<?php

namespace App\Entity;

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
}

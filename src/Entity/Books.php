<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BooksRepository")
 */
class Books
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
    private $authorLastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $authorFirstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $publishedYear;

    /**
     * @ORM\Column(type="string", length=75, nullable=true)
     */
    private $publishedHouse;

    public function getId()
    {
        return $this->id;
    }

    public function getAuthorLastName(): ?string
    {
        return $this->authorLastName;
    }

    public function setAuthorLastName(string $authorLastName): self
    {
        $this->authorLastName = $authorLastName;

        return $this;
    }

    public function getAuthorFirstName(): ?string
    {
        return $this->authorFirstName;
    }

    public function setAuthorFirstName(string $authorFirstName): self
    {
        $this->authorFirstName = $authorFirstName;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }


    public function getPublishedYear(): ?int
    {
        return $this->publishedYear;
    }

    public function setPublishedYear(?int $publishedYear): self
    {
        $this->publishedYear = $publishedYear;

        return $this;
    }

    public function getPublishedHouse(): ?string
    {
        return $this->publishedHouse;
    }

    public function setPublishedHouse(?string $publishedHouse): self
    {
        $this->publishedHouse = $publishedHouse;

        return $this;
    }
}

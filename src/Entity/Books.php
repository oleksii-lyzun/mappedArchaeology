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
    private $author_lastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author_firstName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $addedAt;

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

    public function getAuthor_lastName(): ?string
    {
        return $this->author_lastName;
    }

    public function setAuthor_lastName(string $author_lastName): self
    {
        $this->author_lastName = $author_lastName;

        return $this;
    }

    public function getAuthor_firstName(): ?string
    {
        return $this->author_firstName;
    }

    public function setAuthor_firsName(string $author_firstName): self
    {
        $this->author_firstName = $author_firstName;

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

    public function getAddedAt(): ?\DateTimeInterface
    {
        return $this->addedAt;
    }

    public function setAddedAt(?\DateTimeInterface $addedAt): self
    {
        $this->addedAt = $addedAt;

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

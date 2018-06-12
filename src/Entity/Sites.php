<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SitesRepository")
 */
class Sites
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
    private $site_name_ua;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $site_name_en;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $site_sh_desc_ua;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $site_sh_desc_en;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $site_desc_ua;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $site_desc_en;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_published;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=5, nullable=true)
     */
    private $latitude;

    /**
     * @ORM\Column(type="decimal", precision=7, scale=5, nullable=true)
     */
    private $longitude;

    public function getId()
    {
        return $this->id;
    }

    public function getSiteNameUa(): ?string
    {
        return $this->site_name_ua;
    }

    public function setSiteNameUa(string $site_name_ua): self
    {
        $this->site_name_ua = $site_name_ua;

        return $this;
    }

    public function getSiteNameEn(): ?string
    {
        return $this->site_name_en;
    }

    public function setSiteNameEn(string $site_name_en): self
    {
        $this->site_name_en = $site_name_en;

        return $this;
    }

    public function getSiteShDescUa(): ?string
    {
        return $this->site_sh_desc_ua;
    }

    public function setSiteShDescUa(?string $site_sh_desc_ua): self
    {
        $this->site_sh_desc_ua = $site_sh_desc_ua;

        return $this;
    }

    public function getSiteShDescEn(): ?string
    {
        return $this->site_sh_desc_en;
    }

    public function setSiteShDescEn(?string $site_sh_desc_en): self
    {
        $this->site_sh_desc_en = $site_sh_desc_en;

        return $this;
    }

    public function getSiteDescUa(): ?string
    {
        return $this->site_desc_ua;
    }

    public function setSiteDescUa(?string $site_desc_ua): self
    {
        $this->site_desc_ua = $site_desc_ua;

        return $this;
    }

    public function getSiteDescEn(): ?string
    {
        return $this->site_desc_en;
    }

    public function setSiteDescEn(?string $site_desc_en): self
    {
        $this->site_desc_en = $site_desc_en;

        return $this;
    }

    public function getIsPublished(): ?bool
    {
        return $this->is_published;
    }

    public function setIsPublished(bool $is_published): self
    {
        $this->is_published = $is_published;

        return $this;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function setLatitude($latitude): self
    {
        $this->latitude = $latitude;

        return $this;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    public function setLongitude($longitude): self
    {
        $this->longitude = $longitude;

        return $this;
    }
}

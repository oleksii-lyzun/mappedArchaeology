<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\JoinTable;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SitesRepository")
 * @Vich\Uploadable
 * @ORM\HasLifecycleCallbacks
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
     * @ORM\Column(type="text", length=500, nullable=true)
     */
    private $site_sh_desc_ua;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $site_desc_ua;

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

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $height;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Eras", inversedBy="site")
     * @JoinTable(name="sites_eras")
     */
    private $era;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Periods", inversedBy="site")
     */
    private $period;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Cultures", inversedBy="site")
     */
    private $culture;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string
     */
    private $image;

    /**
     * @Vich\UploadableField(mapping="sites_images", fileNameProperty="image")
     * @var File
     */
    private $imageFile;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    public function __construct()
    {
        $this->culture = new ArrayCollection();
        $this->period = new ArrayCollection();
        $this->era = new ArrayCollection();

        $this->updatedAt = new \DateTime('now');
    }

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

    public function getSiteDescUa(): ?string
    {
        return $this->site_desc_ua;
    }

    public function setSiteDescUa(?string $site_desc_ua): self
    {
        $this->site_desc_ua = $site_desc_ua;

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

    public function getHeight(): ?int
    {
        return $this->height;
    }

    public function setHeight(?int $height): self
    {
        $this->height = $height;

        return $this;
    }

    /**
     * @return Collection|Cultures[]
     */
    public function getCulture(): Collection
    {
        return $this->culture;
    }

    public function addCulture(Cultures $culture): self
    {
        if (!$this->culture->contains($culture)) {
            $this->culture[] = $culture;
        }

        return $this;
    }

    public function removeCulture(Cultures $culture): self
    {
        if ($this->culture->contains($culture)) {
            $this->culture->removeElement($culture);
        }

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

    /**
     * @return Collection|Eras[]
     */
    public function getEra(): Collection
    {
        return $this->era;
    }

    public function addEra(Eras $era): self
    {
        if (!$this->era->contains($era)) {
            $this->era[] = $era;
        }

        return $this;
    }

    public function removeEra(Eras $era): self
    {
        if ($this->era->contains($era)) {
            $this->era->removeElement($era);
        }

        return $this;
    }

    public function __toString() {
        return $this->site_name_en;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt(): \DateTime
    {
        return $this->updatedAt;
    }


    /**
     * @param File|null $image
     */
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($image) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    /**
     * @return string
     * : strung
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @param \DateTime $updatedAt\
     */
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return File
     */
    public function getImageFile()
    {
        return $this->imageFile;
    }

}

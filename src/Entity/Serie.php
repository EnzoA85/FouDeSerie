<?php

namespace App\Entity;

use App\Repository\SerieRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints  as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Table(name:'serie')]
#[ORM\Entity(repositoryClass: SerieRepository::class)]
#[UniqueEntity('titre',message : 'Une série qui porte ce nom existe déjà')]
class Serie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $resume = null;

    #[ORM\Column(type: Types::TIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $duree = null;

    #[Assert\LessThan('today')]
    #[ORM\Column(name:'premiereDiffusion', type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $premiereDiffusion = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $image = null;

    #[ORM\ManyToMany(targetEntity: Genre::class, inversedBy: 'series')]
    private Collection $genres;

    #[ORM\Column]
    private ?int $likes = null;

    public function __construct()
    {
        $this->genres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getResume(): ?string
    {
        return $this->resume;
    }

    public function setResume(?string $resume): self
    {
        $this->resume = $resume;

        return $this;
    }

    public function getDuree(): ?\DateTimeInterface
    {
        return $this->duree;
    }

    public function setDuree(?\DateTimeInterface $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getPremiereDiffusion(): ?\DateTimeInterface
    {
        return $this->premiereDiffusion;
    }

    public function setPremiereDiffusion(?\DateTimeInterface $premiereDiffusion): self
    {
        $this->premiereDiffusion = $premiereDiffusion;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection<int, Genre>
     */
    public function getGenres(): Collection
    {
        return $this->genres;
    }

    public function addGenre(Genre $genre): self
    {
        if (!$this->genres->contains($genre)) {
            $this->genres->add($genre);
        }

        return $this;
    }

    public function removeGenre(Genre $genre): self
    {
        $this->genres->removeElement($genre);

        return $this;
    }

    public function getLikes(): ?int
    {
        return $this->likes;
    }

    public function setLikes(int $likes): self
    {
        $this->likes = $likes;

        return $this;
    }

    public function isNewSerie()
    {
        $currentDate = new DateTime('now');
        if ($this->getPremiereDiffusion()->diff($currentDate)->format('%y')) {
            return false;
        } else {
            return true;
        }
    }
}

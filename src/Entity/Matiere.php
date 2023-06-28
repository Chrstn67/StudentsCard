<?php

namespace App\Entity;

use App\Repository\MatiereRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MatiereRepository::class)]
class Matiere
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\ManyToMany(targetEntity: Interro::class)]
    private Collection $interro;

    #[ORM\ManyToMany(targetEntity: Prof::class)]
    private Collection $prof;

    public function __construct()
    {
        $this->interro = new ArrayCollection();
        $this->prof = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Interro>
     */
    public function getInterro(): Collection
    {
        return $this->interro;
    }

    public function addInterro(Interro $interro): static
    {
        if (!$this->interro->contains($interro)) {
            $this->interro->add($interro);
        }

        return $this;
    }

    public function removeInterro(Interro $interro): static
    {
        $this->interro->removeElement($interro);

        return $this;
    }

    /**
     * @return Collection<int, Prof>
     */
    public function getProf(): Collection
    {
        return $this->prof;
    }

    public function addProf(Prof $prof): static
    {
        if (!$this->prof->contains($prof)) {
            $this->prof->add($prof);
        }

        return $this;
    }

    public function removeProf(Prof $prof): static
    {
        $this->prof->removeElement($prof);

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }
}

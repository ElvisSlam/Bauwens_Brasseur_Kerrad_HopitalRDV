<?php

namespace App\Entity;


use App\Repository\MedecinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: MedecinRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'Medecin:item']),
        new GetCollection(normalizationContext: ['groups' => 'Medecin:list'])
    ]
)]
class Medecin extends User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['Medecin:list', 'Medecin:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['Statut:list', 'Statut:item'])]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Groups(['Statut:list', 'Statut:item'])]
    private ?string $prenom = null;

    #[ORM\OneToMany(mappedBy: 'medecin', targetEntity: RDV::class)]
    #[Groups(['Statut:list', 'Statut:item'])]
    private Collection $rDVs;

    #[ORM\OneToMany(mappedBy: 'medecin', targetEntity: Assistant::class)]
    #[Groups(['Statut:list', 'Statut:item'])]
    private Collection $assistants;

    #[ORM\OneToMany(mappedBy: 'medecin', targetEntity: Indisponibilite::class)]
    #[Groups(['Statut:list', 'Statut:item'])]
    private Collection $indisponibilites;

    public function __construct()
    {
        $this->rDVs = new ArrayCollection();
        $this->assistants = new ArrayCollection();
        $this->indisponibilites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection<int, RDV>
     */
    public function getRDVs(): Collection
    {
        return $this->rDVs;
    }

    public function addRDV(RDV $rDV): self
    {
        if (!$this->rDVs->contains($rDV)) {
            $this->rDVs->add($rDV);
            $rDV->setMedecin($this);
        }

        return $this;
    }

    public function removeRDV(RDV $rDV): self
    {
        if ($this->rDVs->removeElement($rDV)) {
            // set the owning side to null (unless already changed)
            if ($rDV->getMedecin() === $this) {
                $rDV->setMedecin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Assistant>
     */
    public function getAssistants(): Collection
    {
        return $this->assistants;
    }

    public function addAssistant(Assistant $assistant): self
    {
        if (!$this->assistants->contains($assistant)) {
            $this->assistants->add($assistant);
            $assistant->setMedecin($this);
        }

        return $this;
    }

    public function removeAssistant(Assistant $assistant): self
    {
        if ($this->assistants->removeElement($assistant)) {
            // set the owning side to null (unless already changed)
            if ($assistant->getMedecin() === $this) {
                $assistant->setMedecin(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Indisponibilite>
     */
    public function getIndisponibilites(): Collection
    {
        return $this->indisponibilites;
    }

    public function addIndisponibilite(Indisponibilite $indisponibilite): self
    {
        if (!$this->indisponibilites->contains($indisponibilite)) {
            $this->indisponibilites->add($indisponibilite);
            $indisponibilite->setMedecin($this);
        }

        return $this;
    }

    public function removeIndisponibilite(Indisponibilite $indisponibilite): self
    {
        if ($this->indisponibilites->removeElement($indisponibilite)) {
            // set the owning side to null (unless already changed)
            if ($indisponibilite->getMedecin() === $this) {
                $indisponibilite->setMedecin(null);
            }
        }

        return $this;
    }
}

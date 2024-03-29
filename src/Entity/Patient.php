<?php

namespace App\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: PatientRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'Patient:item']),
        new GetCollection(normalizationContext: ['groups' => 'Patient:list'])
    ]
)]
class Patient extends User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['Patient:list', 'Patient:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['Patient:list', 'Patient:item'])]
    private ?string $nom = null;

    #[ORM\Column(length: 255)]
    #[Groups(['Patient:list', 'Patient:item'])]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    #[Groups(['Patient:list', 'Patient:item'])]
    private ?string $adresse = null;

    #[ORM\OneToMany(mappedBy: 'patient', targetEntity: RDV::class)]
    #[Groups(['Patient:list', 'Patient:item'])]
    private Collection $rDVs;

    public function __construct()
    {
        $this->rDVs = new ArrayCollection();
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

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

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
            $rDV->setPatient($this);
        }

        return $this;
    }

    public function removeRDV(RDV $rDV): self
    {
        if ($this->rDVs->removeElement($rDV)) {
            // set the owning side to null (unless already changed)
            if ($rDV->getPatient() === $this) {
                $rDV->setPatient(null);
            }
        }

        return $this;
    }
}

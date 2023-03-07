<?php

namespace App\Entity;


use App\Repository\StatutRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\ApiResource;

#[ORM\Entity(repositoryClass: StatutRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'Statut:item']),
        new GetCollection(normalizationContext: ['groups' => 'Statut:list'])
    ]
)]
class Statut
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['Statut:list', 'Statut:item'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['Statut:list', 'Statut:item'])]
    private ?string $libelle = null;

    #[ORM\OneToMany(mappedBy: 'statut', targetEntity: RDV::class)]
    #[Groups(['Statut:list', 'Statut:item'])]
    private Collection $rDVs;

    public function __construct()
    {
        $this->rDVs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

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
            $rDV->setStatut($this);
        }

        return $this;
    }

    public function removeRDV(RDV $rDV): self
    {
        if ($this->rDVs->removeElement($rDV)) {
            // set the owning side to null (unless already changed)
            if ($rDV->getStatut() === $this) {
                $rDV->setStatut(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->libelle;
    }
}

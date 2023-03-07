<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\RDVRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;

#[ORM\Entity(repositoryClass: RDVRepository::class)]
#[ApiResource(
    operations: [
        new Get(normalizationContext: ['groups' => 'rdv:item']),
        new GetCollection(normalizationContext: ['groups' => 'rdv:list'])
    ]
)]
class RDV
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['rdv:list', 'rdv:item'])]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['rdv:list', 'rdv:item'])]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    #[Groups(['rdv:list', 'rdv:item'])]
    private ?\DateTimeInterface $heure = null;

    #[ORM\Column(type: Types::TIME_MUTABLE)]
    #[Groups(['rdv:list', 'rdv:item'])]
    private ?\DateTimeInterface $duree = null;

    #[ORM\ManyToOne(inversedBy: 'rDVs')]
    private ?Patient $patient = null;

    #[ORM\ManyToOne(inversedBy: 'rDVs')]
    private ?Medecin $medecin = null;

    #[ORM\ManyToOne(inversedBy: 'rDVs')]
    #[Groups(['rdv:list', 'rdv:item'])]
    private ?Statut $statut = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getHeure(): ?\DateTimeInterface
    {
        return $this->heure;
    }

    public function setHeure(\DateTimeInterface $heure): self
    {
        $this->heure = $heure;

        return $this;
    }

    public function getDuree(): ?\DateTimeInterface
    {
        return $this->duree;
    }

    public function setDuree(\DateTimeInterface $duree): self
    {
        $this->duree = $duree;

        return $this;
    }

    public function getPatient(): ?Patient
    {
        return $this->patient;
    }

    public function setPatient(?Patient $patient): self
    {
        $this->patient = $patient;

        return $this;
    }

    public function getMedecin(): ?Medecin
    {
        return $this->medecin;
    }

    public function setMedecin(?Medecin $medecin): self
    {
        $this->medecin = $medecin;

        return $this;
    }

    public function getStatut(): ?Statut
    {
        return $this->statut;
    }

    public function setStatut(?Statut $statut): self
    {
        $this->statut = $statut;

        return $this;
    }

    public function getIdPatient(): ?int
    {
        $patient = $this->patient;
        $id = $patient->getId();
        return $id;
    }
}

<?php

namespace App\Entity;

use App\Repository\FicheDePaieRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FicheDePaieRepository::class)]
class FicheDePaie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name:"id_fiche")]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false,name:"id_user",referencedColumnName:"id_user")]
    private ?User $user = null;

    #[ORM\Column]
    private ?float $salaire_de_base = null;

    #[ORM\Column]
    private ?float $prime_de_presence = null;

    #[ORM\Column]
    private ?float $prime_de_rendement = null;

    #[ORM\Column]
    private ?float $retenue_cnrps = null;

    #[ORM\Column]
    private ?float $deduction_situation_familiale = null;

    #[ORM\Column]
    private ?float $autre_deduction = null;

    #[ORM\Column]
    private ?float $salaire_brut_imposable = null;

    #[ORM\Column]
    private ?float $avance = null;

    #[ORM\Column]
    private ?float $salaire_net = null;

    #[ORM\Column]
    private ?int $heures_supplimentaires = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getSalaireDeBase(): ?float
    {
        return $this->salaire_de_base;
    }

    public function setSalaireDeBase(float $salaire_de_base): static
    {
        $this->salaire_de_base = $salaire_de_base;

        return $this;
    }

    public function getPrimeDePresence(): ?float
    {
        return $this->prime_de_presence;
    }

    public function setPrimeDePresence(float $prime_de_presence): static
    {
        $this->prime_de_presence = $prime_de_presence;

        return $this;
    }

    public function getPrimeDeRendement(): ?float
    {
        return $this->prime_de_rendement;
    }

    public function setPrimeDeRendement(float $prime_de_rendement): static
    {
        $this->prime_de_rendement = $prime_de_rendement;

        return $this;
    }

    public function getRetenueCnrps(): ?float
    {
        return $this->retenue_cnrps;
    }

    public function setRetenueCnrps(float $retenue_cnrps): static
    {
        $this->retenue_cnrps = $retenue_cnrps;

        return $this;
    }

    public function getDeductionSituationFamiliale(): ?float
    {
        return $this->deduction_situation_familiale;
    }

    public function setDeductionSituationFamiliale(float $deduction_situation_familiale): static
    {
        $this->deduction_situation_familiale = $deduction_situation_familiale;

        return $this;
    }

    public function getAutreDeduction(): ?float
    {
        return $this->autre_deduction;
    }

    public function setAutreDeduction(float $autre_deduction): static
    {
        $this->autre_deduction = $autre_deduction;

        return $this;
    }

    public function getSalaireBrutImposable(): ?float
    {
        return $this->salaire_brut_imposable;
    }

    public function setSalaireBrutImposable(float $salaire_brut_imposable): static
    {
        $this->salaire_brut_imposable = $salaire_brut_imposable;

        return $this;
    }

    public function getAvance(): ?float
    {
        return $this->avance;
    }

    public function setAvance(float $avance): static
    {
        $this->avance = $avance;

        return $this;
    }

    public function getSalaireNet(): ?float
    {
        return $this->salaire_net;
    }

    public function setSalaireNet(float $salaire_net): static
    {
        $this->salaire_net = $salaire_net;

        return $this;
    }

    public function getHeuresSupplimentaires(): ?int
    {
        return $this->heures_supplimentaires;
    }

    public function setHeuresSupplimentaires(int $heures_supplimentaires): static
    {
        $this->heures_supplimentaires = $heures_supplimentaires;

        return $this;
    }
}

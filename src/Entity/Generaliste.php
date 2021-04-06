<?php

namespace App\Entity;

use App\Repository\GeneralisteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=GeneralisteRepository::class)
 */
class Generaliste
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Inscription::class, inversedBy="generalistes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $inscription;


    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Symptome;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Antecedents;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Traitements;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $temperature;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $pressionArterielle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $gorge;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $tympans;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $palpation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $auscultation;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $percussion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInscription(): ?Inscription
    {
        return $this->inscription;
    }

    public function setInscription(?Inscription $inscription): self
    {
        $this->inscription = $inscription;

        return $this;
    }


    public function getSymptome(): ?string
    {
        return $this->Symptome;
    }

    public function setSymptome(string $Symptome): self
    {
        $this->Symptome = $Symptome;

        return $this;
    }

    public function getAntecedents(): ?string
    {
        return $this->Antecedents;
    }

    public function setAntecedents(string $Antecedents): self
    {
        $this->Antecedents = $Antecedents;

        return $this;
    }

    public function getTraitements(): ?string
    {
        return $this->Traitements;
    }

    public function setTraitements(string $Traitements): self
    {
        $this->Traitements = $Traitements;

        return $this;
    }

    public function getTemperature(): ?string
    {
        return $this->temperature;
    }

    public function setTemperature(string $temperature): self
    {
        $this->temperature = $temperature;

        return $this;
    }

    public function getPressionArterielle(): ?string
    {
        return $this->pressionArterielle;
    }

    public function setPressionArterielle(string $pressionArterielle): self
    {
        $this->pressionArterielle = $pressionArterielle;

        return $this;
    }

    public function getGorge(): ?string
    {
        return $this->gorge;
    }

    public function setGorge(string $gorge): self
    {
        $this->gorge = $gorge;

        return $this;
    }

    public function getTympans(): ?string
    {
        return $this->tympans;
    }

    public function setTympans(string $tympans): self
    {
        $this->tympans = $tympans;

        return $this;
    }

    public function getPalpation(): ?string
    {
        return $this->palpation;
    }

    public function setPalpation(string $palpation): self
    {
        $this->palpation = $palpation;

        return $this;
    }

    public function getAuscultation(): ?string
    {
        return $this->auscultation;
    }

    public function setAuscultation(string $auscultation): self
    {
        $this->auscultation = $auscultation;

        return $this;
    }

    public function getPercussion(): ?string
    {
        return $this->percussion;
    }

    public function setPercussion(string $percussion): self
    {
        $this->percussion = $percussion;

        return $this;
    }
}

<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\GeneralisteRepository;

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

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

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

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}

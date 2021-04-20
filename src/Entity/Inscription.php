<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\InscriptionRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=InscriptionRepository::class)
 */
class Inscription
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $contact;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $profession;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $orienter;

    /**
     * @ORM\OneToMany(targetEntity=Maladie::class, mappedBy="inscription")
     */
    private $maladies;

    /**
     * @ORM\OneToMany(targetEntity=Generaliste::class, mappedBy="inscription")
     */
    private $generalistes;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\OneToMany(targetEntity=Medicament::class, mappedBy="inscription")
     */
    private $medicaments;

    /**
     * @ORM\OneToMany(targetEntity=Charge::class, mappedBy="inscription")
     */
    private $charges;

    public function __construct()
    {
        $this->maladies = new ArrayCollection();
        $this->generalistes = new ArrayCollection();
        $this->medicaments = new ArrayCollection();
        $this->charges = new ArrayCollection();
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

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getProfession(): ?string
    {
        return $this->profession;
    }

    public function setProfession(string $profession): self
    {
        $this->profession = $profession;

        return $this;
    }

    public function getOrienter(): ?string
    {
        return $this->orienter;
    }

    public function setOrienter(?string $orienter): self
    {
        $this->orienter = $orienter;

        return $this;
    }

    /**
     * @return Collection|Maladie[]
     */
    public function getMaladies(): Collection
    {
        return $this->maladies;
    }

    public function addMalady(Maladie $malady): self
    {
        if (!$this->maladies->contains($malady)) {
            $this->maladies[] = $malady;
            $malady->setInscription($this);
        }

        return $this;
    }

    public function removeMalady(Maladie $malady): self
    {
        if ($this->maladies->removeElement($malady)) {
            // set the owning side to null (unless already changed)
            if ($malady->getInscription() === $this) {
                $malady->setInscription(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Generaliste[]
     */
    public function getGeneralistes(): Collection
    {
        return $this->generalistes;
    }

    public function addGeneraliste(Generaliste $generaliste): self
    {
        if (!$this->generalistes->contains($generaliste)) {
            $this->generalistes[] = $generaliste;
            $generaliste->setInscription($this);
        }

        return $this;
    }

    public function removeGeneraliste(Generaliste $generaliste): self
    {
        if ($this->generalistes->removeElement($generaliste)) {
            // set the owning side to null (unless already changed)
            if ($generaliste->getInscription() === $this) {
                $generaliste->setInscription(null);
            }
        }

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

    /**
     * @return Collection|Medicament[]
     */
    public function getMedicaments(): Collection
    {
        return $this->medicaments;
    }

    public function addMedicament(Medicament $medicament): self
    {
        if (!$this->medicaments->contains($medicament)) {
            $this->medicaments[] = $medicament;
            $medicament->setInscription($this);
        }

        return $this;
    }

    public function removeMedicament(Medicament $medicament): self
    {
        if ($this->medicaments->removeElement($medicament)) {
            // set the owning side to null (unless already changed)
            if ($medicament->getInscription() === $this) {
                $medicament->setInscription(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Charge[]
     */
    public function getCharges(): Collection
    {
        return $this->charges;
    }

    public function addCharge(Charge $charge): self
    {
        if (!$this->charges->contains($charge)) {
            $this->charges[] = $charge;
            $charge->setInscription($this);
        }

        return $this;
    }

    public function removeCharge(Charge $charge): self
    {
        if ($this->charges->removeElement($charge)) {
            // set the owning side to null (unless already changed)
            if ($charge->getInscription() === $this) {
                $charge->setInscription(null);
            }
        }

        return $this;
    }
}

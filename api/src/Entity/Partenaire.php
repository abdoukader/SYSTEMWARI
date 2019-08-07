<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\PartenaireRepository")
 */
class Partenaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Vous devez insérer un téléphone")
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Vous devez insérer un téléphone")
     */
    private $ninea;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Vous devez insérer un téléphone")
     */
    private $adresse;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="Vous devez insérer un téléphone")
     * @Assert\Regex(
     *     pattern="/^(\+[1-9][0-9]*(\([0-9]*\)|-[0-9]*-))?[0]?[1-9][0-9\-]*$/",
     *     match=true,
     *     message="Votre numero ne doit pas contenir de lettre"
     * )
     */
    private $tel;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Vous devez insérer un téléphone")
     */
    private $mail;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Compte", mappedBy="partenaire")
     * @Assert\NotBlank(message="Vous devez insérer un téléphone")
     */
    private $comptes;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="partenaires")
     */
    private $user;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Depot", mappedBy="partenaire")
     */
    private $depots;

    public function __construct()
    {
        $this->comptes = new ArrayCollection();
        $this->depots = new ArrayCollection();
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

    public function getNinea(): ?string
    {
        return $this->ninea;
    }

    public function setNinea(string $ninea): self
    {
        $this->ninea = $ninea;

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

    public function getTel(): ?int
    {
        return $this->tel;
    }

    public function setTel(int $tel): self
    {
        $this->tel = $tel;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->mail;
    }

    public function setMail(string $mail): self
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * @return Collection|Compte[]
     */
    public function getComptes(): Collection
    {
        return $this->comptes;
    }

    public function addCompte(Compte $compte): self
    {
        if (!$this->comptes->contains($compte)) {
            $this->comptes[] = $compte;
            $compte->setPartenaire($this);
        }

        return $this;
    }

    public function removeCompte(Compte $compte): self
    {
        if ($this->comptes->contains($compte)) {
            $this->comptes->removeElement($compte);
            // set the owning side to null (unless already changed)
            if ($compte->getPartenaire() === $this) {
                $compte->setPartenaire(null);
            }
        }

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection|Depot[]
     */
    public function getDepots(): Collection
    {
        return $this->depots;
    }

    public function addDepot(Depot $depot): self
    {
        if (!$this->depots->contains($depot)) {
            $this->depots[] = $depot;
            $depot->setPartenaire($this);
        }

        return $this;
    }

    public function removeDepot(Depot $depot): self
    {
        if ($this->depots->contains($depot)) {
            $this->depots->removeElement($depot);
            // set the owning side to null (unless already changed)
            if ($depot->getPartenaire() === $this) {
                $depot->setPartenaire(null);
            }
        }

        return $this;
    }

}

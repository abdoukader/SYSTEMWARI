<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Assert\NotBlank(message="Vous devez insérer un mot de passe")
     */
    private $username;
    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];
    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Assert\Length(min="6", minMessage="Ce champ doit contenir un minimum de 6 caractères")
     * @Assert\NotBlank(message="Vous devez insérer un mot de passe")
     */
    private $password;
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="2",minMessage="Ce champ doit contenir un minimum de 2 lettres")
     * @Assert\NotBlank(message="Vous devez insérer un mot de passe")
     */
    private $nom;
    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * @Assert\Length(min="2",minMessage="Ce champ doit contenir un minimum de 2 lettres")
     * @Assert\NotBlank(message="Vous devez insérer un mot de passe")
     */
    private $prenom;
    /**
     * @ORM\Column(type="integer")
     * @Assert\Length(min="7",minMessage="Ce champ doit contenir un minimum de 7 chiffres")
     * @Assert\NotBlank(message="Vous devez insérer un mot de passe")
     * @Assert\Regex(
     *     pattern="/^(\+[1-9][0-9]*(\([0-9]*\)|-[0-9]*-))?[0]?[1-9][0-9\-]*$/",
     *     match=true,
     *     message="Votre numero ne doit pas contenir de lettre"
     * )
     */
    private $tel;
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Vous devez insérer un mot de passe")
     */
    private $mail;
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Vous devez insérer un mot de passe")
     */
    private $adresse;
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Vous devez insérer un mot de passe")
     */
    private $statut;
    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="Vous devez insérer un mot de passe")
     */
    private $ninea;
    /**
     * @ORM\Column(type="string", length=255)
     */
    private $profil;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Partenaire", mappedBy="user")
     */
    private $partenaires;
    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Depot", mappedBy="user")
     */
    private $depots;
    public function __construct()
    {
        $this->partenaires = new ArrayCollection();
        $this->depots = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUsername(): string
    {
        return (string) $this->username;
    }
    public function setUsername(string $username): self
    {
        $this->username = $username;
        return $this;
    }
    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';
        return array_unique($roles);
    }
    public function setRoles(array $roles): self
    {
        $this->roles = $roles;
        return $this;
    }
    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }
    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }
    /**
     * @see UserInterface
     */
    public function getSalt()
    {
        // not needed when using the "bcrypt" algorithm in security.yaml
    }
    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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
    public function setPrenom(?string $prenom): self
    {
        $this->prenom = $prenom;
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
    public function getAdresse(): ?string
    {
        return $this->adresse;
    }
    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;
        return $this;
    }
    public function getStatut(): ?string
    {
        return $this->statut;
    }
    public function setStatut(string $statut): self
    {
        $this->statut = $statut;
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
    public function getProfil(): ?string
    {
        return $this->profil;
    }
    public function setProfil(string $profil): self
    {
        $this->profil = $profil;
        return $this;
    }
    /**
     * @return Collection|Partenaire[]
     */
    public function getPartenaires(): Collection
    {
        return $this->partenaires;
    }
    public function addPartenaire(Partenaire $partenaire): self
    {
        if (!$this->partenaires->contains($partenaire)) {
            $this->partenaires[] = $partenaire;
            $partenaire->setUser($this);
        }
        return $this;
    }
    public function removePartenaire(Partenaire $partenaire): self
    {
        if ($this->partenaires->contains($partenaire)) {
            $this->partenaires->removeElement($partenaire);
            // set the owning side to null (unless already changed)
            if ($partenaire->getUser() === $this) {
                $partenaire->setUser(null);
            }
        }
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
            $depot->setUser($this);
        }
        return $this;
    }
    public function removeDepot(Depot $depot): self
    {
        if ($this->depots->contains($depot)) {
            $this->depots->removeElement($depot);
            // set the owning side to null (unless already changed)
            if ($depot->getUser() === $this) {
                $depot->setUser(null);
            }
        }
        return $this;
    }
}

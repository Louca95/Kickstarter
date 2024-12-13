<?php

namespace App\Entity;


use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

// use Symfony\Component\Security\Core\User\UserInterface;
// use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;



#[ORM\Entity(repositoryClass: UserRepository::class)]

class User 
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $mot_de_passe= null;

    #[ORM\Column(length: 255)]
    private ?string $role = null;

    

    /**
     * @var Collection<int, Projet>
     */
    #[ORM\OneToMany(targetEntity: Projet::class, mappedBy: 'user_id')]
    private Collection $projets;

    /**
     * @var Collection<int, Contribution>
     */
    #[ORM\OneToMany(targetEntity: Contribution::class, mappedBy: 'utilisateur_id')]
    private Collection $contributions;

    public function __construct()
    {
        $this->projets = new ArrayCollection();
        $this->contributions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    

    public function getMotDePasse(): ?string
    {
        return $this->mot_de_passe;
    }

    public function setMotDePasse(string $motDePasse): self
    {
        $this->mot_de_passe = $motDePasse;

        return $this;
    }

    public function getRole(): ?string
    {
        return $this->role;
    }

    public function setRole(string $role): static
    {
        $this->role = $role;

        return $this;
    }
    


    public function getPassword(): string
    {
        return $this->mot_de_passe;
    }

    /**
     * Set the password after hashing.
     */
    // public function setMotDePasse(string $mot_de_passe): self
    // {
    //     $this->mot_de_passe = $mot_de_passe;

    //     return $this;
    // }

    // You must also implement other methods required by `UserInterface`
    public function getRoles(): array
    {
        return ['ROLE_USER']; // Example role
    }

    public function getUsername(): string
    {
        // Return the username or email, depending on your setup
        return $this->email;
    }

    public function eraseCredentials(): void
    {
        // If any sensitive data needs to be erased, you can do so here
    }


    /**
     * @return Collection<int, Projet>
     */
    public function getProjets(): Collection
    {
        return $this->projets;
    }

    public function addProjet(Projet $projet): static
    {
        if (!$this->projets->contains($projet)) {
            $this->projets->add($projet);
            $projet->setUserId($this);
        }

        return $this;
    }

    public function removeProjet(Projet $projet): static
    {
        if ($this->projets->removeElement($projet)) {
            // set the owning side to null (unless already changed)
            if ($projet->getUserId() === $this) {
                $projet->setUserId(null);
            }
        }

        return $this;
    }

    

    /**
     * @return Collection<int, Contribution>
     */
    public function getContributions(): Collection
    {
        return $this->contributions;
    }

    public function addContribution(Contribution $contribution): static
    {
        if (!$this->contributions->contains($contribution)) {
            $this->contributions->add($contribution);
            $contribution->setUtilisateur($this);
        }

        return $this;
    }

    public function removeContribution(Contribution $contribution): static
    {
        if ($this->contributions->removeElement($contribution)) {
            // set the owning side to null (unless already changed)
            if ($contribution->getUtilisateur() === $this) {
                $contribution->setUtilisateur(null);
            }
        }

        return $this;
    }
}

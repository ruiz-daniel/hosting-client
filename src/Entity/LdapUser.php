<?php

namespace App\Entity;

use App\Repository\LdapUserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LdapUserRepository::class)
 */
class LdapUser
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
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\OneToOne(targetEntity=Client::class, inversedBy="ldapUser", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\OneToMany(targetEntity=HostedSite::class, mappedBy="ldapUser", orphanRemoval=true)
     */
    private $hostedSites;

    public function __construct($username, $password)
    {
        $this->username = $username;
        $this->password = $password;
        $this->hostedSites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getClient(): ?client
    {
        return $this->client;
    }

    public function setClient(client $client): self
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @return Collection|HostedSite[]
     */
    public function getHostedSites(): Collection
    {
        return $this->hostedSites;
    }

    public function addHostedSite(HostedSite $hostedSite): self
    {
        if (!$this->hostedSites->contains($hostedSite)) {
            $this->hostedSites[] = $hostedSite;
            $hostedSite->setLdapUser($this);
        }

        return $this;
    }

    public function removeHostedSite(HostedSite $hostedSite): self
    {
        if ($this->hostedSites->removeElement($hostedSite)) {
            // set the owning side to null (unless already changed)
            if ($hostedSite->getLdapUser() === $this) {
                $hostedSite->setLdapUser(null);
            }
        }

        return $this;
    }
}

<?php

namespace App\Entity;

use App\Repository\SiteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SiteRepository::class)
 */
class Site
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
    private $site_id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $alias;

    /**
     * @ORM\ManyToOne(targetEntity=client::class, inversedBy="sites", cascade={"persist"})
     */
    private $client;

    /**
     * @ORM\OneToOne(targetEntity=HostedSite::class, mappedBy="site", cascade={"persist", "remove"})
     */
    private $hostedSite;

    public function __construct($name, $alias)
    {
        $this->site_id = $name;
        $this->alias = $alias;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->site_id;
    }

    public function setName(string $name): self
    {
        $this->site_id = $name;

        return $this;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(?string $alias): self
    {
        $this->alias = $alias;

        return $this;
    }

    public function getClient(): ?client
    {
        return $this->client;
    }

    public function setClient(?client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getHostedSite(): ?HostedSite
    {
        return $this->hostedSite;
    }

    public function setHostedSite(HostedSite $hostedSite): self
    {
        // set the owning side of the relation if necessary
        if ($hostedSite->getSite() !== $this) {
            $hostedSite->setSite($this);
        }

        $this->hostedSite = $hostedSite;

        return $this;
    }
}

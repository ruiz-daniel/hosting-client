<?php

namespace App\Entity;

use App\Repository\SiteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $alias;

    /**
     * @ORM\ManyToOne(targetEntity=Client::class, inversedBy="sites", cascade={"persist"})
     */
    private $client;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity=LdapUser::class, mappedBy="site", orphanRemoval=true)
     */
    private $ldapUsers;

    /**
     * @ORM\OneToOne(targetEntity=quota::class, cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $quota;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $index_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $protected_dir;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $php_version;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $node_js;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $db_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $db_user;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $db_password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $template_version;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $web_server;

    /**
     * @ORM\Column(type="integer")
     */
    private $web_server_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $db_server_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $template_id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $hosted;

    public function __construct($name, $alias)
    {
        $this->name = $name;
        $this->alias = $alias;
        $this->ldapUsers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    /**
     * @return Collection|LdapUser[]
     */
    public function getLdapUsers(): Collection
    {
        return $this->ldapUsers;
    }

    public function addLdapUser(LdapUser $ldapUser): self
    {
        if (!$this->ldapUsers->contains($ldapUser)) {
            $this->ldapUsers[] = $ldapUser;
            $ldapUser->setSite($this);
        }

        return $this;
    }

    public function removeLdapUser(LdapUser $ldapUser): self
    {
        if ($this->ldapUsers->removeElement($ldapUser)) {
            // set the owning side to null (unless already changed)
            if ($ldapUser->getSite() === $this) {
                $ldapUser->setSite(null);
            }
        }

        return $this;
    }

    public function getQuota(): ?quota
    {
        return $this->quota;
    }

    public function setQuota(quota $quota): self
    {
        $this->quota = $quota;

        return $this;
    }

    public function getIndexName(): ?string
    {
        return $this->index_name;
    }

    public function setIndexName(?string $index_name): self
    {
        $this->index_name = $index_name;

        return $this;
    }

    public function getProtectedDir(): ?string
    {
        return $this->protected_dir;
    }

    public function setProtectedDir(?string $protected_dir): self
    {
        $this->protected_dir = $protected_dir;

        return $this;
    }

    public function getPhpVersion(): ?string
    {
        return $this->php_version;
    }

    public function setPhpVersion(?string $php_version): self
    {
        $this->php_version = $php_version;

        return $this;
    }

    public function getNodeJs(): ?bool
    {
        return $this->node_js;
    }

    public function setNodeJs(?bool $node_js): self
    {
        $this->node_js = $node_js;

        return $this;
    }

    public function getDbName(): ?string
    {
        return $this->db_name;
    }

    public function setDbName(?string $db_name): self
    {
        $this->db_name = $db_name;

        return $this;
    }

    public function getDbUser(): ?string
    {
        return $this->db_user;
    }

    public function setDbUser(?string $db_user): self
    {
        $this->db_user = $db_user;

        return $this;
    }

    public function getDbPassword(): ?string
    {
        return $this->db_password;
    }

    public function setDbPassword(?string $db_password): self
    {
        $this->db_password = $db_password;

        return $this;
    }

    public function getTemplateVersion(): ?string
    {
        return $this->template_version;
    }

    public function setTemplateVersion(?string $template_version): self
    {
        $this->template_version = $template_version;

        return $this;
    }

    public function getWebServer(): ?string
    {
        return $this->web_server;
    }

    public function setWebServer(string $web_server): self
    {
        $this->web_server = $web_server;

        return $this;
    }

    public function getWebServerId(): ?int
    {
        return $this->web_server_id;
    }

    public function setWebServerId(int $web_server_id): self
    {
        $this->web_server_id = $web_server_id;

        return $this;
    }

    public function getDbServerId(): ?int
    {
        return $this->db_server_id;
    }

    public function setDbServerId(int $db_server_id): self
    {
        $this->db_server_id = $db_server_id;

        return $this;
    }

    public function getTemplateId(): ?int
    {
        return $this->template_id;
    }

    public function setTemplateId(int $template_id): self
    {
        $this->template_id = $template_id;

        return $this;
    }

    public function getHosted(): ?bool
    {
        return $this->hosted;
    }

    public function setHosted(bool $hosted): self
    {
        $this->hosted = $hosted;

        return $this;
    }
}

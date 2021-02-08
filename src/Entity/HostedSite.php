<?php

namespace App\Entity;

use App\Repository\HostedSiteRepository;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HostedSiteRepository::class)
 */
class HostedSite
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $web_server;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $php_version;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $uses_nodejs;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $db_server;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $db_password;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $template_version;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $protected_dir;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $index_name;

    /**
     * @ORM\ManyToOne(targetEntity=LdapUser::class, inversedBy="hostedSites")
     * @ORM\JoinColumn(nullable=false)
     */
    private $ldapUser;

    /**
     * @ORM\Column(type="integer")
     */
    private $template_id;

    /**
     * @ORM\OneToOne(targetEntity=Site::class, cascade={"persist", "remove"})
     */
    private $site;

    public function __construct($web_server, $php_version, $uses_nodejs, $db_server, $db_password, $template, $template_version, $protected_dir, $index_name)
    {
        $this->web_server = $web_server;
        $this->php_version = $php_version;
        $this->uses_nodejs = $uses_nodejs;
        $this->db_server = $db_server;
        $this->db_password = $db_password;
        $this->template_id = $template;
        $this->template_version = $template_version;
        $this->protected_dir = $protected_dir;
        $this->index_name = $index_name;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getWebServer(): ?int
    {
        return $this->web_server;
    }

    public function setWebServer(int $web_server): self
    {
        $this->web_server = $web_server;

        return $this;
    }

    public function getPhpVersion(): ?string
    {
        return $this->php_version;
    }

    public function setPhpVersion(string $php_version): self
    {
        $this->php_version = $php_version;

        return $this;
    }

    public function getUsesNodejs(): ?bool
    {
        return $this->uses_nodejs;
    }

    public function setUsesNodejs(?bool $uses_nodejs): self
    {
        $this->uses_nodejs = $uses_nodejs;

        return $this;
    }

    public function getDbServer(): ?int
    {
        return $this->db_server;
    }

    public function setDbServer(int $db_server): self
    {
        $this->db_server = $db_server;

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

    public function setTemplateVersion(string $template_version): self
    {
        $this->template_version = $template_version;

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

    public function getIndexName(): ?string
    {
        return $this->index_name;
    }

    public function setIndexName(string $index_name): self
    {
        $this->index_name = $index_name;

        return $this;
    }

    public function getLdapUser(): ?LdapUser
    {
        return $this->ldapUser;
    }

    public function setLdapUser(?LdapUser $ldapUser): self
    {
        $this->ldapUser = $ldapUser;

        return $this;
    }

    public function getTemplate(): ?int
    {
        return $this->template_id;
    }

    public function setTemplate(int $template): self
    {
        $this->template_id = $template;

        return $this;
    }

    public function getSite(): ?Site
    {
        return $this->site;
    }

    public function setSite(?Site $site): self
    {
        $this->site = $site;

        return $this;
    }
}

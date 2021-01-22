<?php

namespace App\Entity;

use App\Repository\FormDataRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FormDataRepository::class)
 */
class FormData
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
    private $ldapName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ldapLastName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ldapEmail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ldapPhone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $client_type;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $siteName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $siteDomain;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $alias;

    /**
     * @ORM\Column(type="integer")
     */
    private $diskSpace;

    /**
     * @ORM\Column(type="integer")
     */
    private $extraDiskSpace;

    /**
     * @ORM\Column(type="integer")
     */
    private $dbSpace;

    /**
     * @ORM\Column(type="integer")
     */
    private $extraDBSpace;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $packetName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ldapPassword;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $webServer;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $phpVersion;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $node;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dbServer;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $dbPassword;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $webTech;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $webTechVersion;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $protctedFiles;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $indexName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLdapName(): ?string
    {
        return $this->ldapName;
    }

    public function setLdapName(string $ldapName): self
    {
        $this->ldapName = $ldapName;

        return $this;
    }

    public function getLdapLastName(): ?string
    {
        return $this->ldapLastName;
    }

    public function setLdapLastName(string $ldapLastName): self
    {
        $this->ldapLastName = $ldapLastName;

        return $this;
    }

    public function getLdapEmail(): ?string
    {
        return $this->ldapEmail;
    }

    public function setLdapEmail(string $ldapEmail): self
    {
        $this->ldapEmail = $ldapEmail;

        return $this;
    }

    public function getLdapPhone(): ?string
    {
        return $this->ldapPhone;
    }

    public function setLdapPhone(string $ldapPhone): self
    {
        $this->ldapPhone = $ldapPhone;

        return $this;
    }

    public function getClientType(): ?string
    {
        return $this->client_type;
    }

    public function setClientType(string $client_type): self
    {
        $this->client_type = $client_type;

        return $this;
    }

    public function getSiteName(): ?string
    {
        return $this->siteName;
    }

    public function setSiteName(string $siteName): self
    {
        $this->siteName = $siteName;

        return $this;
    }

    public function getSiteDomain(): ?string
    {
        return $this->siteDomain;
    }

    public function setSiteDomain(string $siteDomain): self
    {
        $this->siteDomain = $siteDomain;

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

    public function getDiskSpace(): ?int
    {
        return $this->diskSpace;
    }

    public function setDiskSpace(int $diskSpace): self
    {
        $this->diskSpace = $diskSpace;

        return $this;
    }

    public function getExtraDiskSpace(): ?int
    {
        return $this->extraDiskSpace;
    }

    public function setExtraDiskSpace(int $extraDiskSpace): self
    {
        $this->extraDiskSpace = $extraDiskSpace;

        return $this;
    }

    public function getDbSpace(): ?int
    {
        return $this->dbSpace;
    }

    public function setDbSpace(int $dbSpace): self
    {
        $this->dbSpace = $dbSpace;

        return $this;
    }

    public function getExtraDBSpace(): ?int
    {
        return $this->extraDBSpace;
    }

    public function setExtraDBSpace(int $extraDBSpace): self
    {
        $this->extraDBSpace = $extraDBSpace;

        return $this;
    }

    public function getPacketName(): ?string
    {
        return $this->packetName;
    }

    public function setPacketName(?string $packetName): self
    {
        $this->packetName = $packetName;

        return $this;
    }

    public function getLdapPassword(): ?string
    {
        return $this->ldapPassword;
    }

    public function setLdapPassword(string $ldapPassword): self
    {
        $this->ldapPassword = $ldapPassword;

        return $this;
    }

    public function getWebServer(): ?string
    {
        return $this->webServer;
    }

    public function setWebServer(string $webServer): self
    {
        $this->webServer = $webServer;

        return $this;
    }

    public function getPhpVersion(): ?string
    {
        return $this->phpVersion;
    }

    public function setPhpVersion(?string $phpVersion): self
    {
        $this->phpVersion = $phpVersion;

        return $this;
    }

    public function getNode(): ?bool
    {
        return $this->node;
    }

    public function setNode(?bool $node): self
    {
        $this->node = $node;

        return $this;
    }

    public function getDbServer(): ?string
    {
        return $this->dbServer;
    }

    public function setDbServer(string $dbServer): self
    {
        $this->dbServer = $dbServer;

        return $this;
    }

    public function getDbPassword(): ?string
    {
        return $this->dbPassword;
    }

    public function setDbPassword(string $dbPassword): self
    {
        $this->dbPassword = $dbPassword;

        return $this;
    }

    public function getWebTech(): ?string
    {
        return $this->webTech;
    }

    public function setWebTech(string $webTech): self
    {
        $this->webTech = $webTech;

        return $this;
    }

    public function getWebTechVersion(): ?string
    {
        return $this->webTechVersion;
    }

    public function setWebTechVersion(string $webTechVersion): self
    {
        $this->webTechVersion = $webTechVersion;

        return $this;
    }

    public function getProtctedFiles(): ?string
    {
        return $this->protctedFiles;
    }

    public function setProtctedFiles(?string $protctedFiles): self
    {
        $this->protctedFiles = $protctedFiles;

        return $this;
    }

    public function getIndexName(): ?string
    {
        return $this->indexName;
    }

    public function setIndexName(string $indexName): self
    {
        $this->indexName = $indexName;

        return $this;
    }
}

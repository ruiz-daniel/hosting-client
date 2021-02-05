<?php

namespace App\Entity;

use App\Repository\PacketRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PacketRepository::class)
 */
class Packet
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
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $disk_space;

    /**
     * @ORM\Column(type="integer")
     */
    private $db_space;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $client_type;

    public function __construct()
    {
        $this->contracts = new ArrayCollection();
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

    public function getDiskSpace(): ?int
    {
        return $this->disk_space;
    }

    public function setDiskSpace(int $disk_space): self
    {
        $this->disk_space = $disk_space;

        return $this;
    }

    public function getDbSpace(): ?int
    {
        return $this->db_space;
    }

    public function setDbSpace(int $db_space): self
    {
        $this->db_space = $db_space;

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
}

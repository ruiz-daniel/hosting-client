<?php

namespace App\Entity;

use App\Repository\QuotaRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=QuotaRepository::class)
 */
class Quota
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $extra_disk_space;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $extra_db_space;

    /**
     * @ORM\ManyToOne(targetEntity=Packet::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $packet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getExtraDiskSpace(): ?int
    {
        return $this->extra_disk_space;
    }

    public function setExtraDiskSpace(?int $extra_disk_space): self
    {
        $this->extra_disk_space = $extra_disk_space;

        return $this;
    }

    public function getExtraDbSpace(): ?int
    {
        return $this->extra_db_space;
    }

    public function setExtraDbSpace(?int $extra_db_space): self
    {
        $this->extra_db_space = $extra_db_space;

        return $this;
    }

    public function getPacket(): ?Packet
    {
        return $this->packet;
    }

    public function setPacket(?Packet $packet): self
    {
        $this->packet = $packet;

        return $this;
    }
}

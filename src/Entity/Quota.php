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
     * @ORM\Column(type="integer")
     */
    private $packet_id;

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

    public function getPacketId(): ?int
    {
        return $this->packet_id;
    }

    public function setPacketId(int $packet_id): self
    {
        $this->packet_id = $packet_id;

        return $this;
    }
}
